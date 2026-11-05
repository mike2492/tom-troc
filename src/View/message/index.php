<section class="messaging">
    <div class="container messaging__inner">
        <div class="messaging__list">
            <h1><?= htmlspecialchars($title) ?></h1>
            <?php foreach($conversations as $contactId => $message): ?>
                <a href="index.php?controller=message&action=index&id=<?= $contactId ?>" class="messaging__contact">

                    <?php if($contacts[$contactId]->getAvatar() !== null): ?>
                        <img src="uploads/avatars/<?= htmlspecialchars($contacts[$contactId]->getAvatar()) ?>" alt="">
                    <?php else: ?>
                        <img src="https://picsum.photos/48/48" alt="">
                    <?php endif; ?>

                    <div class="messaging__content">
                        <div class="messaging__top">
                            <p class="messaging__name"><?= htmlspecialchars($contacts[$contactId]->getUsername()) ?></p>
                            <p class="messaging__time"><?= (new DateTimeImmutable($message->getSentAt()))->format('H:i') ?></p>
                        </div>
                        <p class="messaging__preview"><?= htmlspecialchars(mb_substr($message->getContent(), 0, 50)) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="messaging__thread">
            <?php if($selected !== null): ?>
                <div class="messaging__header">
                    <?php if($selected->getAvatar() !== null): ?>
                        <img src="uploads/avatars/<?= htmlspecialchars($selected->getAvatar()) ?>" alt="">
                    <?php else: ?>
                        <img src="https://picsum.photos/48/48" alt="">
                    <?php endif; ?>
                    <h2><?= htmlspecialchars($selected->getUsername()) ?></h2>
                </div>

                <div class="messaging__messages">
                    <?php foreach($thread as $msg): ?>
                        <div class="messaging__message <?= $msg->getSenderId() === $_SESSION['user_id'] ? 'messaging__message--sent' : 'messaging__message--received' ?>">
                            <p class="messaging__date">
                                <?php if($msg->getSenderId() !== $_SESSION['user_id']): ?>
                                    <?php if($selected->getAvatar() !== null): ?>
                                        <img src="uploads/avatars/<?= htmlspecialchars($selected->getAvatar()) ?>" alt="">
                                    <?php else: ?>
                                        <img src="https://picsum.photos/48/48" alt="">
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?= (new DateTimeImmutable($msg->getSentAt()))->format('d.m H:i') ?>
                            </p>
                            <p class="messaging__text"><?= htmlspecialchars($msg->getContent()) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if(!empty($errors)): ?>
                    <div class="errors">
                        <?php foreach($errors as $error): ?>
                            <p class="error">* <?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" class="messaging__form">
                    <input type="text" name="content" placeholder="Tapez votre message ici">
                    <button type="submit">Envoyer</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>