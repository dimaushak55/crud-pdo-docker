<h2>Clients</h2>
<a href="?entity=client&action=create">➕ Add client</a>

<ul>
<?php foreach ($clients as $c): ?>
  <li>
    <?= htmlspecialchars($c['name']) ?>
    <a href="?entity=client&action=view&id=<?= $c['id'] ?>">👁</a>
    <a href="?entity=client&action=edit&id=<?= $c['id'] ?>">✏️</a>
    <a href="?entity=client&action=delete&id=<?= $c['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>
