<h2>Product</h2>

<p>Name: <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></p>
<p>Price: <?= htmlspecialchars((string)$product['price'], ENT_QUOTES, 'UTF-8') ?></p>

<a href="?entity=product">← Back</a>