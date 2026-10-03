<h1><?= $book->getTitle() ?></h1>
<p>par : <?= $book->getAuthor() ?></p>
<p><?= $book->getDescription() ?></p>
<p><a href="index.php?controller=user&action=show&id=<?= $owner->getId() ?>"><?= $owner->getUsername() ?></a></p>
<a href="index.php?controller=message&action=index&user=<?= $owner->getId() ?>">Envoyer un message</a>