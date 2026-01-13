<h2>Edit order</h2>

<form method="post">

  <label>Client</label>
  <select name="client_id">
    <?php foreach ($clients as $c): ?>
      <option value="<?= (int)$c['id'] ?>"
        <?= (int)$c['id'] === (int)$order['client_id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Product</label>
  <select name="product_id">
    <?php foreach ($products as $p): ?>
      <option value="<?= (int)$p['id'] ?>"
        <?= (int)$p['id'] === (int)$order['product_id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input name="client_address"
         value="<?= htmlspecialchars($order['client_address'], ENT_QUOTES, 'UTF-8') ?>"
         placeholder="Address">

  <input name="total_amount"
         value="<?= htmlspecialchars((string)$order['total_amount'], ENT_QUOTES, 'UTF-8') ?>"
         placeholder="Total amount">

  <input name="order_date"
         value="<?= htmlspecialchars($order['order_date'], ENT_QUOTES, 'UTF-8') ?>"
         placeholder="Order date">

  <input name="contract_number"
         value="<?= htmlspecialchars($order['contract_number'], ENT_QUOTES, 'UTF-8') ?>"
         placeholder="Contract number">

  <button>Update</button>
</form>