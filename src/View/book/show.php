<h1><?= htmlspecialchars($title) ?></h1>
<p>par : <?= htmlspecialchars($book->getAuthor()) ?></p>
<h2>Description</h2>
<p><?= htmlspecialchars($book->getDescription()) ?></p>
<h2>Propriétaire</h2>
<p><a href="index.php?controller=account&action=show&id=<?= $owner->getId() ?>"><?= htmlspecialchars($owner->getUsername()) ?></a></p>

<a href="index.php?controller=message&action=index&id=<?= $owner->getId() ?>">Envoyer un message</a>