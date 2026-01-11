<h2>Edit delivery</h2>

<form method="post">

  <label>Order</label>
  <select name="order_id">
    <?php foreach ($orders as $o): ?>
      <option value="<?= $o['id'] ?>"
        <?= $o['id'] == $delivery['order_id'] ? 'selected' : '' ?>>
        Order #<?= $o['id'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input name="date"
         value="<?= htmlspecialchars($delivery['date']) ?>"
         placeholder="Delivery date">

  <input name="product_number"
         value="<?= $delivery['product_number'] ?>"
         placeholder="Product number">

  <button>Update</button>
</form>
