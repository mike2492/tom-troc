<section class="exchange">
    <div class="container">
        <div class="exchange-top">
            <h1><?= htmlspecialchars($title) ?></h1>

            <form action="" method="GET">
                <input type="hidden" name="controller" value="book">
                <input type="hidden" name="action" value="index">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Rechercher un livre">
            </form>
        </div>

        <div class="books-grid">
            <?php foreach($books as $book): ?>
                 <a href="index.php?controller=book&action=show&id=<?= $book->getId() ?>">
                    <div class="book-card">
                        <?php if($book->getStatus() === 'unavailable'): ?>
                            <span class="badge">non dispo.</span>
                        <?php endif; ?>
                        <img src="https://picsum.photos/200/200" alt="">
                        <h3 class="book-title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="book-author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <p class="book-owner">Vendu par : <?= htmlspecialchars($owners[$book->getId()]) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>