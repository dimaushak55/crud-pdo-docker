<h2>Clients</h2>
<a href="?entity=client&action=create">➕ Add client</a>

<ul>
<?php foreach ($clients as $c): ?>
  <li>
    <?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?>
    <a href="?entity=client&action=view&id=<?= (int)$c['id'] ?>">👁</a>
    <a href="?entity=client&action=edit&id=<?= (int)$c['id'] ?>">✏️</a>
    <a href="?entity=client&action=delete&id=<?= (int)$c['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>

