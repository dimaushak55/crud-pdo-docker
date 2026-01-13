<h2>Orders</h2>
<a href="?entity=order&action=create">➕ Add order</a>

<ul>
<?php foreach ($orders as $o): ?>
  <li>
    <?= htmlspecialchars($o['client_name'], ENT_QUOTES, 'UTF-8') ?>
    —
    <?= htmlspecialchars($o['product_name'], ENT_QUOTES, 'UTF-8') ?>

    <a href="?entity=order&action=view&id=<?= (int)$o['id'] ?>">👁</a>
    <a href="?entity=order&action=edit&id=<?= (int)$o['id'] ?>">✏️</a>
    <a href="?entity=order&action=delete&id=<?= (int)$o['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>