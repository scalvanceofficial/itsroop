helllo
<!DOCTYPE html>
<html>

<head>
    <title>Refund Completed – Order #{{ $data['order_number'] }}</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">
    <h4>Thank You, {{ $data['customer_name'] }}! 🙏</h4>

    <p>We’re happy to let you know that your refund has been successfully completed.🎉
    </p>

    <h3>🔁 Refund Summary:</h3>
    <ul>
        <li><strong>Product:</strong> {{ $data['product_name'] }}</li>
        <li><strong>Quantity:</strong> {{ $data['quantity'] }}</li>
        <li><strong>Refund Amount:</strong> {{ toIndianCurrency($data['refund_amount']) }}</li>
    </ul>

    <p>
        <a href="{{ url('/') }}"
            style="background:#4CAF50; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;">Explore
            More</a>
    </p>

    <p>If you have any questions or need assistance, our support team is always happy to help.</p>

    <p>Thanks for choosing Bamboo Street – where every purchase makes a difference! 🌏</p>

    <p>Warm regards,<br>
        The Bamboo Street Team</p>
</body>

</html>
