<h1><?= htmlspecialchars($otherUser->getUsername()) ?></h1>
<?php foreach($messages as $message): ?>
    <?php if($message->getSenderId() === $_SESSION['user_id']): ?>
        <p><?= htmlspecialchars($message->getSentAt()) ?> Moi : <?= htmlspecialchars($message->getContent()) ?></p>
    <?php else: ?>
        <p><?= htmlspecialchars($message->getSentAt()) ?> <?= htmlspecialchars($otherUser->getUsername()) ?> : <?= htmlspecialchars($message->getContent()) ?></p>
    <?php endif; ?>
<?php endforeach; ?>

<form method="POST">
    <label for="content">Message</label>
    <textarea name="content" id="content"></textarea>
    <?php if(isset($errors['content'])): ?>
        <p><?= htmlspecialchars($errors['content']) ?></p>
    <?php endif; ?>

    <button type="submit">Envoyer</button>
</form>