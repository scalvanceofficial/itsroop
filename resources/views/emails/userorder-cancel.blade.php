<!DOCTYPE html>
<html>

<head>
    <title>Your Order #{{ $data['order_number'] }} has been Cancelled ❌</title>
</head>

<body>
    <h4>Hello {{ $data['customer_name'] }},</h4>

    <p>We regret to inform you that your order <strong>#{{ $data['order_number'] }}</strong> has been
        <strong>cancelled</strong>. 😞
    </p>

    <p>If this was a mistake or you have any questions, please don’t hesitate to reach out to our support team. We’re
        here to help! 🤝</p>

    <h3>🧾 <strong>Order Summary:</strong></h3>
    <ul>
        @foreach ($data['order_products'] as $order_product)
            <li><strong>{{ $order_product->product->name }}</strong> – {{ $order_product->quantity }} x
                {{ toIndianCurrency($order_product->price) }}
            </li>
        @endforeach
    </ul>

    <p><strong>Total Amount:</strong> {{ toIndianCurrency($data['total_amount']) }}</p>

    <p>We value your support and look forward to serving you again soon with our eco-friendly, sustainable products. 🌿

    <p>
        <a href="{{ url('/') }}"
            style="background:#4CAF50; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;">Explore
            More</a>
    </p>

    <p>Thank you for choosing a greener future with Bamboo Street! 🍃</p>

    <p>Warm regards,<br>
        The Bamboo Street Team</p>
</body>

</html>
