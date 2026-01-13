<h2>Edit delivery</h2>

<form method="post">

  <label>Order</label>
  <select name="order_id">
    <?php foreach ($orders as $o): ?>
      <option value="<?= (int)$o['id'] ?>"
        <?= (int)$o['id'] === (int)$delivery['order_id'] ? 'selected' : '' ?>>
        Order #<?= (int)$o['id'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input name="date"
         value="<?= htmlspecialchars($delivery['date'], ENT_QUOTES, 'UTF-8') ?>"
         placeholder="Delivery date">

  <input name="product_number"
         value="<?= htmlspecialchars((string)$delivery['product_number'], ENT_QUOTES, 'UTF-8') ?>"
         placeholder="Product number">

  <button>Update</button>
</form>
