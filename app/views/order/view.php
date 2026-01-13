<h2>Order</h2>

<p>Client: <?= htmlspecialchars($order['client_name'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Product: <?= htmlspecialchars($order['product_name'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Address: <?= htmlspecialchars($order['client_address'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Total: <?= htmlspecialchars((string)$order['total_amount'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Date: <?= htmlspecialchars($order['order_date'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Contract #: <?= htmlspecialchars($order['contract_number'], ENT_QUOTES, 'UTF-8') ?></p>

<a href="?entity=order">← Back</a>

