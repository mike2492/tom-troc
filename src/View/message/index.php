<h1>Messagerie</h1>
<?php if(empty($conversations)): ?>
    <p>Aucun message pour le moment</p>
<?php else: ?>
    <?php foreach($conversations as $otherId => $message): ?>
        <a href="index.php?controller=message&action=thread&user=<?= $otherId ?>">
            <p><?= htmlspecialchars($users[$otherId]->getUsername()) ?></p>
            <p><?= htmlspecialchars($message->getSentAt()) ?></p>
            <p><?= htmlspecialchars(mb_strimwidth($message->getContent(), 0, 40, '...')) ?></p>
        </a>
    <?php endforeach; ?>
<?php endif; ?>