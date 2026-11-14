<?php // "Nos livres à l'échange": all books, with a search on the title. ?>
<section class="exchange">
    <div class="container">
        <div class="exchange-top">
            <h1><?= htmlspecialchars($title) ?></h1>

            <?php // GET form: the search appears in the URL. The hidden fields keep the route (controller and action). ?>
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
                        <?php // Red badge on books that cannot be exchanged for now. ?>
                        <?php if($book->getStatus() === 'unavailable'): ?>
                            <span class="badge">non dispo.</span>
                        <?php endif; ?>
                        <?php // Uploaded photo if any, otherwise a placeholder. ?>
                        <?php if($book->getImage() !== null): ?>
                            <img src="uploads/books/<?= htmlspecialchars($book->getImage()) ?>" alt="">
                        <?php else: ?>
                            <img src="https://picsum.photos/200/200" alt="">
                        <?php endif; ?>
                        <h3 class="book-title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="book-author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <?php // $owners is indexed by book id (built in the controller). ?>
                        <p class="book-owner">Vendu par : <?= htmlspecialchars($owners[$book->getId()]) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>