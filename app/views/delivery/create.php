<h2>Create delivery</h2>
<form method="post">
  <select name="order_id">
    <?php foreach ($orders as $o): ?>
      <option value="<?= $o['id'] ?>">Order #<?= $o['id'] ?></option>
    <?php endforeach; ?>
  </select>
  <input name="date" placeholder="Date">
  <input name="product_number" placeholder="Product number">
  <button>Create</button>
</form>
