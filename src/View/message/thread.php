<h1><?= htmlspecialchars($otherUser->getUsername()) ?></h1>

<div class="messages">
    <?php foreach ($messages as $message): ?>
        <div class="message <?= $message->getSenderId() == $_SESSION['user_id'] ? 'Envoyé' : 'Reçu' ?>">
            <p><?= htmlspecialchars($message->getContent()) ?></p>
            <span><?= $message->getSentAt()->format('d.m H:i') ?></span>
        </div>
    <?php endforeach; ?>
</div>

<form method="POST" action="index.php?controller=message&action=send">
    <input type="hidden" name="receiver_id" value="<?= $otherUser->getId() ?>">
    <textarea name="content" placeholder="Tapez votre message ici"></textarea>
    <button type="submit">Envoyer</button>
</form>