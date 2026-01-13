<h2>Delivery</h2>

<p>Order ID: <?= (int)$delivery['order_id'] ?></p>
<p>Date: <?= htmlspecialchars($delivery['date'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Product number: <?= htmlspecialchars((string)$delivery['product_number'], ENT_QUOTES, 'UTF-8') ?></p>

<a href="?entity=delivery">← Back</a>