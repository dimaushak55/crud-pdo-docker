<h2>Edit order</h2>

<form method="post">

  <label>Client</label>
  <select name="client_id">
    <?php foreach ($clients as $c): ?>
      <option value="<?= $c['id'] ?>"
        <?= $c['id'] == $order['client_id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($c['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Product</label>
  <select name="product_id">
    <?php foreach ($products as $p): ?>
      <option value="<?= $p['id'] ?>"
        <?= $p['id'] == $order['product_id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($p['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input name="client_address"
         value="<?= htmlspecialchars($order['client_address']) ?>"
         placeholder="Address">

  <input name="total_amount"
         value="<?= $order['total_amount'] ?>"
         placeholder="Total amount">

  <input name="order_date"
         value="<?= $order['order_date'] ?>"
         placeholder="Order date">

  <input name="contract_number"
         value="<?= htmlspecialchars($order['contract_number']) ?>"
         placeholder="Contract number">

  <button>Update</button>
</form>

