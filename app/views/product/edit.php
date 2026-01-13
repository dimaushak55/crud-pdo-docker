<h2>Edit product</h2>
<form method="post">

  <input name="name"
         value="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
         required>

  <input name="price"
         value="<?= htmlspecialchars((string)$product['price'], ENT_QUOTES, 'UTF-8') ?>"
         required>

  <button>Update</button>
</form>
