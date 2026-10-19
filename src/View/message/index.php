<h1><?= htmlspecialchars($title) ?></h1>

<?php foreach($conversations as $contactId => $message): ?>
<a href="index.php?controller=message&action=index&id=<?= $contactId ?>">
        <p><?= htmlspecialchars($contacts[$contactId]->getUsername()) ?></p>
        <p><?= htmlspecialchars(mb_substr($message->getContent(), 0, 50)) ?></p>
    </a>
<?php endforeach; ?>

<?php if($selected !== null): ?>
    <h2><?= htmlspecialchars($selected->getUsername()) ?></h2>

    <?php foreach($thread as $msg): ?>
        <p><?= htmlspecialchars($msg->getContent()) ?></p>
    <?php endforeach; ?>

    <form action="" method="POST">
        <input type="text" name="content" placeholder="Tapez votre message ici">
        <button type="submit">Envoyer</button>
    </form>
<?php endif; ?>