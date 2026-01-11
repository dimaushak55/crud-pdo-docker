<h2>Edit client</h2>
<form method="post">
  <input name="name" value="<?= $client['name'] ?>" required>
  <input name="phone" value="<?= $client['phone'] ?>" required>
  <input name="email" value="<?= $client['email'] ?>">
  <input name="address" value="<?= $client['address'] ?>">
  <button>Update</button>
</form>