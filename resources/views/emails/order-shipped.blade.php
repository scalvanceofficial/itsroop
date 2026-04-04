<!DOCTYPE html>
<html>

<head>
    <title>Your Order #{{ $data['order_number'] }} Has Been Shipped 📦</title>
</head>

<body>
    <h4>Hello {{ $data['customer_name'] }},</h4>

    <p>Good news! Your order <strong>#{{ $data['order_number'] }}</strong> has been <strong>shipped</strong> and is on
        its way to you. 🌱</p>

    <p>You’ll receive another update once it’s out for delivery. We’re as excited as you are! 😊</p>

    <h3>🧾 Order Summary:</h3>
    <ul>
        @foreach ($data['order_products'] as $order_product)
            <li><strong>{{ $order_product->product->name }}</strong> – {{ $order_product->quantity }} x
                {{ toIndianCurrency($order_product->price) }}
            </li>
        @endforeach
    </ul>

    <p><strong>Total Amount:</strong> {{ toIndianCurrency($data['total_amount']) }}</p>

    <p>If you have any questions or need support, our team is always happy to help.</p>

    <p>🌍 While you wait, explore more of our sustainable living collection!</p>

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
