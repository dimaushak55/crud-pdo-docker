<h2>Products</h2>
<a href="?entity=product&action=create">➕ Add product</a>

<ul>
<?php foreach ($products as $p): ?>
  <li>
    <?= $p['name'] ?> (<?= $p['price'] ?>)
    <a href="?entity=product&action=view&id=<?= $p['id'] ?>">👁</a>
    <a href="?entity=product&action=edit&id=<?= $p['id'] ?>">✏️</a>
    <a href="?entity=product&action=delete&id=<?= $p['id'] ?>">❌</a>
  </li>
<?php endforeach; ?>
</ul>
