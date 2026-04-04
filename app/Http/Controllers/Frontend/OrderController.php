<?php

namespace App\Http\Controllers\Frontend;


use Exception;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Address;
use App\Models\OrderProduct;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\ShiprocketService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $shiprocket;

    public function __construct(ShiprocketService $shiprocket)
    {
        $this->shiprocket = $shiprocket;
    }

    public function checkout(Request $Request)
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->orderBy('default', 'ASC')->get();

        return view('Frontend.Pages.checkout', compact('user', 'addresses'));
    }

    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'accept_terms' => 'required|boolean',
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'amount' => $validated['amount'] * 100,
            'currency' => 'INR',
            'payment_capture' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'order_id' => $order->id,
            'amount' => $validated['amount'],
            'currency' => 'INR',
            'key' => env('RAZORPAY_KEY')
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $validated = $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'address_id' => 'required',
            'coupon_code_id' => 'nullable|exists:coupon_codes,id'
        ]);

        try {
            $user = Auth::user();
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($validated['razorpay_payment_id']);

            if ($payment->status === 'captured') {
                $carts = Cart::where('user_id', $user->id)->get();

                $prefix = '152356';

                $lastOrder = Order::where('order_number', 'like', $prefix . '%')
                    ->latest('id')
                    ->first();

                $nextNumber = 1;

                if ($lastOrder) {
                    $lastNumber = (int) substr($lastOrder->order_number, strlen($prefix));
                    $nextNumber = $lastNumber + 1;
                }

                $order_number = $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

                $order = Order::create([
                    'user_id' => $user->id,
                    'address_id' => $validated['address_id'],
                    'coupon_code_id' => $validated['coupon_code_id'],
                    'order_number' => $order_number,
                    'razorpay_order_id' => $payment->order_id,
                    'razorpay_payment_id' => $validated['razorpay_payment_id'],
                    'shiprocket_status' => 'NEW',
                    'gst' => ($validated['amount'] / 1.18) * 0.18,
                    'total_amount' => $validated['amount'],
                    'payment_status' => 'COMPLETED',
                    'payment_method' => 'GATEWAY'
                ]);

                foreach ($carts as $cart) {
                    $cart_data = getCartData($cart);

                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'property_values' => $cart->property_values,
                        'property_value_names' => $cart_data['property_values'],
                        'quantity' => $cart->quantity,
                        'price' => $cart_data['price'],
                        'gst' => $cart_data['price'] * 0.18,
                        'total_amount' => $cart->quantity * $cart_data['price'],
                        'coupon_code_id' => $validated['coupon_code_id'],
                    ]);

                    $productPriceQuery = ProductPrice::where('product_id', $cart->product_id);
                    foreach ($cart->property_values as $value) {
                        $productPriceQuery->whereJsonContains('property_values', (int)$value);
                    }
                    $productPrice = $productPriceQuery->first();

                    if ($productPrice) {
                        $newStock = max(0, $productPrice->stock - $cart->quantity);
                        $productPrice->stock = $newStock;
                        $productPrice->save();
                    }
                }

                Cart::where('user_id', $user->id)->delete();

                $data = [
                    'subject' => 'Order Confirmation - #' . $order->order_number,
                    'order_number' => $order->order_number,
                    'customer_name' => $order->user->full_name,
                    'total_amount' => $order->total_amount,
                    'order_products' => $order->products,
                ];

                $variables = $order->order_number . '|' . config('app.url');

                send_sms($order->user->mobile, $variables, 185480);

                EmailService::sendEmail($user->email, 'emails.order-placed', $data);

                return response()->json(['status' => 'success', 'message' => 'Payment verified successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Payment verification failed'], 400);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderByDesc('id')->get();

        return view('Frontend.Pages.orders', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        $tracking_activities = [];

        if (isset($order->shiprocket_tracking_response['tracking_data']['shipment_track_activities'])) {
            $tracking_activities = $order->shiprocket_tracking_response['tracking_data']['shipment_track_activities'];
        }

        return view('Frontend.Pages.order-details', compact('order', 'tracking_activities'));
    }

    public function pdf(Order $order)
    {
        $pdf = Pdf::loadView('Frontend.Pages.order-pdf', compact('order'));
        return $pdf->stream('order-' . $order->order_number . '.pdf');
    }

    public function cancelOrder(Request $request, Order $order)
    {
        $user = Auth::user();
        $shiprocket_order_id = $order->shiprocket_order_id;
        $sms_template_id = 185372;
        $variable = $order->order_number . '|' . config('app.url');

        if ($shiprocket_order_id) {
            $response = $this->shiprocket->cancelOrder($shiprocket_order_id);

            if (!empty($response) && ($response['status_code'] ?? null) === 200) {
                $order->update([
                    'shiprocket_status' => 'Cancelled',
                    'cancellation_reason' => $request->cancellation_reason,
                ]);

                send_sms($order->user->mobile, $variable, $sms_template_id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order cancelled successfully.',
                ]);
            }
        }

        foreach ($order->products as $orderProduct) {
            $productPriceQuery = ProductPrice::where('product_id', $orderProduct->product_id);
            foreach ($orderProduct->property_values as $value) {
                $productPriceQuery->whereJsonContains('property_values', (int)$value);
            }
            $productPrice = $productPriceQuery->first();

            if ($productPrice) {
                $productPrice->stock += $orderProduct->quantity;
                $productPrice->save();
            }
        }

        $order->update([
            'shiprocket_status' => 'Cancelled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        $data = [
            'subject' => 'Order Cancelled - #' . $order->order_number,
            'order_number' => $order->order_number,
            'customer_name' => $order->user->full_name,
            'total_amount' => $order->total_amount,
            'order_products' => $order->products,
        ];

        send_sms($order->user->mobile, $variable, $sms_template_id);

        EmailService::sendEmail($user->email, 'emails.userorder-cancel', $data);

        return response()->json([
            'status' => 'success',
            'message' => 'Order cancelled successfully',
        ]);
    }
}
