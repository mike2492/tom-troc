<div class="profile">
    <img src="<?= htmlspecialchars($user->getAvatar() ?? 'assets/images/default-avatar.png') ?>" alt="">
    <h2><?= htmlspecialchars($user->getUsername()) ?></h2>
    <p>Membre depuis <?= $user->getCreatedAt()->format('Y') ?></p>
    <p>Bibliothèque : <?= count($books) ?> livres</p>

    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !== $user->getId()): ?>
        <a href="index.php?controller=message&action=thread&id=<?= $user->getId() ?>">
            Écrire un message
        </a>
    <?php endif; ?>
</div>

<div class="books">
    <?php foreach($books as $book): ?>
        <a href="index.php?controller=book&action=show&id=<?= $book->getId() ?>">
            <?= htmlspecialchars($book->getTitle()) ?>
        </a>
    <?php endforeach; ?>
</div>