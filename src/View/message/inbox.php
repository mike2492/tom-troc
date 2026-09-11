<h1>Messagerie</h1>

<div class="conversations-list">
    <?php foreach ($conversations as $user): ?>
        <a href="index.php?controller=message&action=thread&id=<?= $user->getId() ?>">
            <?= htmlspecialchars($user->getUsername()) ?>
        </a>
    <?php endforeach; ?>
</div>