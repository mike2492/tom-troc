<h1><?= htmlspecialchars($book->getTitle()) ?></h1>
<p>par <?= htmlspecialchars($book->getAuthor()) ?></p>

<p><?= nl2br(htmlspecialchars($book->getDescription())) ?></p>

<div class="owner">
    <a href="index.php?controller=user&action=publicProfile&id=<?= $owner->getId() ?>">
        <?= htmlspecialchars($owner->getUsername()) ?>
    </a>
</div>

<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !== $owner->getId()): ?>
    <a href="index.php?controller=message&action=thread&id=<?= $owner->getId() ?>">
        Envoyer un message
    </a>
<?php endif; ?>