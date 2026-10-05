<?php foreach($conversations as $otherId => $message): ?>
    <a href="index.php?controller=message&action=thread&user=<?= $otherId ?>">
        <p><?= htmlspecialchars($users[$otherId]->getUsername()) ?></p>
        <p><?= htmlspecialchars($message->getSentAt()) ?></p>
        <p><?= htmlspecialchars(mb_strimwidth($message->getContent(), 0, 40, '...')) ?></p>
    </a>
<?php endforeach; ?>