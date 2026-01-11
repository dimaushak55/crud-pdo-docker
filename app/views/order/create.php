<h2>Create order</h2>
<form method="post">
  <select name="client_id">
    <?php foreach ($clients as $c): ?>
      <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <select name="product_id">
    <?php foreach ($products as $p): ?>
      <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <input name="client_address" placeholder="Address">
  <input name="total_amount" placeholder="Total">
  <input name="order_date" placeholder="Date">
  <input name="contract_number" placeholder="Contract">
  <button>Create</button>
</form>
