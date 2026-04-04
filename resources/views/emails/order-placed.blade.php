<!DOCTYPE html>
<html>

<head>
  <title>Your Order #{{ $data['order_number'] }} is Confirmed! 🌿</title>
</head>

<body>
  <h4>Thank You, {{ $data['customer_name'] }}! 🙏</h4>

  <p>We're excited to let you know that your order <strong>#{{ $data['order_number'] }}</strong> has been
    successfully placed! 🌱</p>

  <p>Our team is carefully packing your eco-friendly Bamboo Street products, and we’ll notify you once they are on the way. 📦🚚</p>

  <h3>🧾 <strong>Order Summary:</strong></h3>
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
    <a href="{{ url('/') }}" style="background:#4CAF50; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;">Explore More</a>
  </p>

  <p>Thank you for choosing a greener future with Bamboo Street! 🍃</p>

  <p>Warm regards,<br>
    The Bamboo Street Team</p>
</body>

</html>
