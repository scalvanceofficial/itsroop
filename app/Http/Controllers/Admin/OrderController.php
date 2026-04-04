<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Exports\OrderExport;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Models\ReturnProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    // Display orders index page
    public function index()
    {
        return view('Admin.Orders.index');
    }

    // Fetch data for DataTable
    public function data(Request $request)
    {
        $query = Order::where('id', '!=', 0)
            ->when($request->user_id, function ($query, $user_id) {
                return $query->where('user_id', $user_id);
            })
            ->when($request->status, function ($query, $status) {
                if ($status == 'NEW') {
                    return $query->where('shiprocket_status', 'NEW');
                } elseif ($status == 'SHIPPED') {
                    return $query->where('shiprocket_status', 'SHIPPED' || 'In Transit' || 'Out for Delivery');
                } elseif ($status == 'DELIVERED') {
                    return $query->where('shiprocket_status', 'DELIVERED');
                } elseif ($status == 'Cancelled') {
                    return $query->where('shiprocket_status', 'Cancelled');
                } else {
                    return $query->whereNotIn('shiprocket_status', ['NEW', 'SHIPPED', 'DELIVERED', 'Cancelled', 'In Transit']);
                }
            })
            ->when($request->from_date && $request->to_date, function ($query) use ($request) {
                $from = Carbon::parse($request->from_date)->startOfDay();
                $to = Carbon::parse($request->to_date)->endOfDay();
                return $query->whereBetween('created_at', [$from, $to]);
            })
            ->orderByDesc('created_at');

        return DataTables::eloquent($query)
            ->editColumn('customer', function ($order) {
                return $order->user->full_name;
            })
            ->editColumn('payment_status', function ($order) {
                return '<span class="badge bg-success fs-1">' . $order->payment_status . '</span>';
            })
            ->editColumn('shiprocket_status', function ($order) {
                return  $order->shiprocket_status;
            })
            ->editColumn('address', function ($order) {
                return $order->address->address_line_1 . ',' . $order->address->address_line_2 . ',' . $order->address->city . ',' . $order->address->pincode;
            })
            ->editColumn('total_amount', function ($order) {
                $refund_amount = 0;

                foreach ($order->products as $order_product) {
                    $returnedQty = ReturnProduct::where('order_id', $order->id)
                        ->where('order_product_id', $order_product->id)
                        ->where('status', 'REFUND_COMPLETED')
                        ->sum('return_quantity');

                    $refund_amount += $returnedQty * ($order_product->price ?? 0);
                }

                $original = '<span class="badge bg-success fs-1 me-1">Total: ' . toIndianCurrency($order->total_amount) . '</span>';
                $refund = '';

                if ($refund_amount > 0) {
                    $refund = '<span class="badge bg-danger fs-1">Refund: ' . toIndianCurrency($refund_amount) . '</span>';
                }

                return $original . $refund;
            })

            ->editColumn('order_products', function ($order) {
                $html = '<div style="overflow-y: auto; max-height: 80px;">';
                $html .= '<ul class="list-unstyled mb-0">';

                foreach ($order->products as $order_product) {
                    $returnedQty = ReturnProduct::where('order_id', $order->id)
                        ->where('order_product_id', $order_product->id)
                        ->where('status', 'REFUND_COMPLETED')
                        ->sum('return_quantity');

                    $product = $order_product->product;

                    $productPrice = ProductPrice::where('product_id', $order_product->product_id)
                        ->whereJsonContains('property_values', array_map('intval', $order_product->property_values ?? []))
                        ->first();

                    $html .= '<li class="d-flex justify-content-between align-items-center mt-2">';
                    $html .= '<span role="button" tabindex="0" class="product-detail-btn" style="cursor:pointer;" 
                    data-name="' . e($product->name) . '" 
                    data-price="' . e(toIndianCurrency($productPrice->selling_price)) . '"
                    data-variants="' . e($order_product->property_value_names) . '" 
                    data-model="' . e($productPrice->model) . '" 
                    data-bs-toggle="modal" 
                    data-bs-target="#productDetailModal">'
                        . e($product->name) . ' (' . $order_product->property_value_names . ')' . '</button>';
                    $html .= '<span class="ms-1 badge bg-success fs-1">' . e($order_product->quantity) . '</span>';
                    $html .= '<span class="ms-1 badge bg-danger fs-1">' . e($returnedQty ?: 0) . '</span>';
                    $html .= '</li>';
                }

                $html .= '</ul>';
                $html .= '</div>';

                return $html;
            })

            ->addColumn('created_at', function ($order) {
                return toIndianDateTime($order->created_at);
            })

            ->addColumn('order_number', function ($order) {
                return $order->order_number;
            })
            ->addColumn('awb_code', function ($order) {
                return $order->awb_code;
            })

            ->addColumn('shiprocket', function ($order) {
                if (!$order->shiprocket_order_id && $order->shiprocket_status != 'Cancelled' && $order->shiprocket_status != 'Delivered') {
                    return '<a href="#" class="btn btn-sm btn-primary fs-1 shiprocket-create-order-btn" data-id=' . $order->id . '>Create</a>';
                } else if ($order->shiprocket_status == 'Cancelled') {
                    return '<span class="badge bg-danger fs-1">Cancelled</span>';
                } else if ($order->shiprocket_status == 'Delivered') {
                    return '<span class="badge bg-success fs-1">Delivered</span>';
                } else {
                    $track = '';
                    if ($order->shiprocket_tracking_response) {
                        $track = '<a href="#" class="btn btn-sm btn-primary fs-1 shiprocket-track-order-btn" data-id=' . $order->id . '>Track</a>';
                    }
                    $cancel = '<a href="#" class="btn btn-sm btn-danger fs-1 shiprocket-cancel-order-btn" data-id=' . $order->id . '>Cancel</a>';
                    $update = '<a href="#" class="btn btn-sm btn-warning fs-1 shiprocket-update-order-btn" data-id="' . $order->id . '">Update</a>';

                    return $track . ' ' . $cancel . ' ' . $update;
                }
            })
            ->addColumn('invoice', function ($order) {
                $pdf = '<a href="' . route('admin.orders.pdf.download', ['order' => $order->id]) . '" 
                            class="btn btn-sm btn   -danger d-flex align-items-center gap-1" 
                            target="_blank" 
                            title="Download PDF">
                            <i class="fas fa-file-pdf me-1"></i> PDF
                        </a>';

                return $pdf;
            })
            ->addIndexColumn()
            ->rawColumns(['order_number', 'awb_code', 'customer', 'payment_status', 'shiprocket_status', 'address', 'total_amount', 'order_products', 'created_at', 'shiprocket', 'invoice', 'status'])
            ->setRowId('id')
            ->make(true);
    }

    // Show create form
    public function create()
    {
        //
    }

    // Store new order in database
    public function store(Request $request)
    {
        //
    }

    // Show order details for editing
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('Admin.Orders.show', compact('order'));
    }

    // Show edit form
    public function edit($id)
    {
        //
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        //
    }

    // Delete an order
    public function destroy($id)
    {
        //
    }

    public function adminCancelOrder(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
            ], 400);
        }

        $order->update([
            'shiprocket_status' => 'Cancelled',
            'status' => 'Cancelled'
        ]);

        $variable = $order->order_number . '|' . config('app.url');

        send_sms($order->user->mobile, $variable, 185371);

        return response()->json([
            'status' => 'success',
            'message' => 'Order cancelled successfully.',
        ]);
    }

    public function restoreOrder(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
            ], 400);
        }

        $order->update([
            'shiprocket_status' => 'PLACED',
            'status' => ''
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order restored successfully.',
        ]);
        // }
    }

    public function pdf(Order $order)
    {
        $pdf = Pdf::loadView('Frontend.Pages.order-pdf', compact('order'));
        return $pdf->stream('order-' . $order->order_number . '.pdf');
    }


    public function export(Request $request)
    {
        return Excel::download(new OrderExport($request), 'orders.xlsx');
    }
}
