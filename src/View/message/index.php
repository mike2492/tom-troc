<h1>Messagerie</h1>
<?php foreach($conversations as $otherUserId => $message): ?>
   <a href="index.php?controller=message&action=index&user=<?= $otherUserId ?>"> 
        <?= $partners[$otherUserId]->getUsername() ?>
        <?= $message->getSentAt()->format('H:i') ?>
        <?= mb_strimwidth($message->getContent(), 0, 40, '...') ?>
    </a>
<?php endforeach; ?>

<?php foreach($thread as $msg): ?>
    <?= $msg->getSentAt()->format('H:i') ?>
    <?= $msg->getContent() ?>
<?php endforeach; ?>

<?php var_dump($_SESSION['user_id']) ?>