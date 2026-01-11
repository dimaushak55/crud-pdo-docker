<h2>Orders</h2>
<a href="?entity=order&action=create">➕ Add order</a>

<ul>
<?php foreach ($orders as $o): ?>
  <li>
    <?= $o['client_name'] ?> — <?= $o['product_name'] ?>
    <a href="?entity=order&action=view&id=<?= $o['id'] ?>">👁</a>
    <a href="?entity=order&action=edit&id=<?= $o['id'] ?>">✏️</a>
    <a href="?entity=order&action=delete&id=<?= $o['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>
