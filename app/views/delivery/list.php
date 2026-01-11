<h2>Deliveries</h2>
<a href="?entity=delivery&action=create">➕ Add delivery</a>

<ul>
<?php foreach ($deliveries as $d): ?>
  <li>
    Order #<?= $d['order_id'] ?> — <?= $d['date'] ?>
    <a href="?entity=delivery&action=view&id=<?= $d['id'] ?>">👁</a>
    <a href="?entity=delivery&action=edit&id=<?= $d['id'] ?>">✏️</a>
    <a href="?entity=delivery&action=delete&id=<?= $d['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>
