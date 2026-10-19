<nav class="breadcrumb">
    <div class="container">
        <a href="index.php?controller=book&action=index">Nos livres</a> &gt; <?= htmlspecialchars($book->getTitle()) ?>
    </div>
</nav>

<section class="book-detail">
    <div class="book-detail__image">
        <img src="https://picsum.photos/720/863" alt="">
    </div>

    <div class="book-detail__info">
        <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
        <p class="book-detail__author">par <?= htmlspecialchars($book->getAuthor()) ?></p>
        <hr>

        <h2>Description</h2>
        <p class="book-detail__description"><?= nl2br(htmlspecialchars($book->getDescription())) ?></p>

        <h2>Propriétaire</h2>
        <a href="index.php?controller=account&action=show&id=<?= $owner->getId() ?>" class="book-detail__owner">
            <img src="https://picsum.photos/48/48" alt="">
            <span><?= htmlspecialchars($owner->getUsername()) ?></span>
        </a>

        <div class="block-btn">
             <a href="index.php?controller=message&action=index&id=<?= $owner->getId() ?>" class="send-message">Envoyer un message</a>
        </div>
    </div>
</section>