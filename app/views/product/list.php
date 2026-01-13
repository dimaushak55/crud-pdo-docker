<h2>Products</h2>
<a href="?entity=product&action=create">➕ Add product</a>

<ul>
<?php foreach ($products as $p): ?>
  <li>
    <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>
    (
    <?= htmlspecialchars((string)$p['price'], ENT_QUOTES, 'UTF-8') ?>
    )

    <a href="?entity=product&action=view&id=<?= (int)$p['id'] ?>">👁</a>
    <a href="?entity=product&action=edit&id=<?= (int)$p['id'] ?>">✏️</a>
    <a href="?entity=product&action=delete&id=<?= (int)$p['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>