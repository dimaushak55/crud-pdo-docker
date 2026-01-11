<h2>Edit product</h2>
<form method="post">
  <input name="name" value="<?= $product['name'] ?>" required>
  <input name="price" value="<?= $product['price'] ?>" required>
  <button>Update</button>
</form>
