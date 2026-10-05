
<img src="https://picsum.photos/720/863" alt="">
<h1><?= htmlspecialchars($book->getTitle()) ?></h1>
<p>par <?= htmlspecialchars($book->getAuthor()) ?></p>
<p>Description</p>
<p><?= htmlspecialchars($book->getDescription()) ?></p>

<?php if(isset($_SESSION['user_id']) && $book->getUserId() === $_SESSION['user_id']): ?>
    <p>Propriétaire : <?= htmlspecialchars($owner->getUsername()) ?></p>
<?php else: ?>
    <p>
        Propriétaire :
        <a href="index.php?controller=profile&action=show&id=<?= $owner->getId() ?>">
            <?= htmlspecialchars($owner->getUsername()) ?>
        </a>
    </p>
    <a href="index.php?controller=message&action=thread&user=<?= $owner->getId() ?>">Envoyer un message</a>
<?php endif; ?>