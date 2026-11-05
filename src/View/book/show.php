<nav class="breadcrumb">
    <div class="container">
        <a href="index.php?controller=book&action=index">Nos livres</a> &gt; <?= htmlspecialchars($book->getTitle()) ?>
    </div>
</nav>

<section class="book-detail">
    <div class="book-detail__image">
        <?php if($book->getImage() !== null): ?>
            <img src="uploads/books/<?= htmlspecialchars($book->getImage()) ?>" alt="">
        <?php else: ?>
            <img src="https://picsum.photos/720/863" alt="">
        <?php endif; ?>
    </div>

    <div class="book-detail__info">
        <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
        <p class="book-detail__author">par <?= htmlspecialchars($book->getAuthor()) ?></p>
        <hr>

        <h2>Description</h2>
        <p class="book-detail__description"><?= nl2br(htmlspecialchars($book->getDescription())) ?></p>

        <h2>Propriétaire</h2>
        <a href="index.php?controller=account&action=show&id=<?= $owner->getId() ?>" class="book-detail__owner">
            <?php if($owner->getAvatar() !== null): ?>
                 <img src="uploads/avatars/<?= htmlspecialchars($owner->getAvatar()) ?>" alt="">
            <?php else: ?>
                <img src="https://picsum.photos/48/48" alt="">
            <?php endif; ?>
            <span><?= htmlspecialchars($owner->getUsername()) ?></span>
        </a>

        <div class="block-btn">
             <a href="index.php?controller=message&action=index&id=<?= $owner->getId() ?>" class="send-message">Envoyer un message</a>
        </div>
    </div>
</section>