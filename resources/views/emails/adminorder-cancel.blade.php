<!DOCTYPE html>
<html>

<head>
    <title>Your Order #{{ $data['order_number'] }} Has Been Cancelled by Bamboo Street ❌</title>
</head>

<body>
    <h4>Hello {{ $data['customer_name'] }},</h4>

    <p>We regret to inform you that your order <strong>#{{ $data['order_number'] }}</strong>
        has been <strong>cancelled by our team at Bamboo Street</strong>.</p>

    <p>We sincerely apologize for the inconvenience caused.</p>

    <p>If you have any questions or would like to place a new order, please don’t hesitate to contact our support
        team —
        we’re here to help!</p>

    <h3>🧾 <strong>Order Summary:</strong></h3>
    <ul>
        @foreach ($data['order_products'] as $order_product)
            <li><strong>{{ $order_product->product->name }}</strong> – {{ $order_product->quantity }} x
                {{ toIndianCurrency($order_product->price) }}
            </li>
        @endforeach
    </ul>

    <p><strong>Total Amount:</strong> {{ toIndianCurrency($data['total_amount']) }}</p>

    <p>We value your support and look forward to serving you again soon with our eco-friendly, sustainable products.
        🌿
    </p>

    <p>
        <a href="{{ url('/') }}"
            style="background:#4CAF50; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;">Explore
            More</a>
    </p>

    <p>Thank you for choosing a greener future with Bamboo Street! 🍃</p>

    <p>Warm regards,<br>
        <strong>The Bamboo Street Team</strong>
    </p>
</body>

</html>
