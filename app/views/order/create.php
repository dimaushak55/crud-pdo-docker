<h2>Create order</h2>
<form method="post">

  <select name="client_id">
    <?php foreach ($clients as $c): ?>
      <option value="<?= (int)$c['id'] ?>">
        <?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?>
      </option>
    <?php endforeach; ?>
  </select>

  <select name="product_id">
    <?php foreach ($products as $p): ?>
      <option value="<?= (int)$p['id'] ?>">
        <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input name="client_address" placeholder="Address">
  <input name="total_amount" placeholder="Total">
  <input name="order_date" placeholder="Date">
  <input name="contract_number" placeholder="Contract">

  <button>Create</button>
</form>