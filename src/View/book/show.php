<h1><?= htmlspecialchars($title) ?></h1>
<p>par : <?= htmlspecialchars($book->getAuthor()) ?></p>
<h2>Description</h2>
<p><?= htmlspecialchars($book->getDescription()) ?></p>
<h2>Propriétaire</h2>
<p><?= htmlspecialchars($owner->getUsername()) ?></p>