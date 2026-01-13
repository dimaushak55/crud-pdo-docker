<h2>Deliveries</h2>
<a href="?entity=delivery&action=create">➕ Add delivery</a>

<ul>
<?php foreach ($deliveries as $d): ?>
  <li>
    Order #<?= (int)$d['order_id'] ?> —
    <?= htmlspecialchars($d['date'], ENT_QUOTES, 'UTF-8') ?>

    <a href="?entity=delivery&action=view&id=<?= (int)$d['id'] ?>">👁</a>
    <a href="?entity=delivery&action=edit&id=<?= (int)$d['id'] ?>">✏️</a>
    <a href="?entity=delivery&action=delete&id=<?= (int)$d['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>
