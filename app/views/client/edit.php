<h2>Edit client</h2>
<form method="post">
  <input name="name" value="<?= htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8') ?>" required>
  <input name="phone" value="<?= htmlspecialchars($client['phone'], ENT_QUOTES, 'UTF-8') ?>" required>
  <input name="email" value="<?= htmlspecialchars($client['email'], ENT_QUOTES, 'UTF-8') ?>">
  <input name="address" value="<?= htmlspecialchars($client['address'], ENT_QUOTES, 'UTF-8') ?>">
  <button>Update</button>
</form>