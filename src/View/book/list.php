<div class="list-books">    
    <div class="books-search">

        <div class="books-title">
            <h1>Nos livres à l'échange</h1>
        </div>

        <div class="books-research">
            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="book">
                <input type="hidden" name="action" value="list">
                <input type="text" name="search" placeholder="Rechercher un livre" value="<?= htmlspecialchars($search ?? '') ?>" class="search-input">
            </form>
        </div>

    </div>

    <div class="books-grid">
        <?php foreach ($books as $book): ?>
            <div class="book-card">
                <div class="book-img">
                    <img src="https://picsum.photos/200/200" alt="">
                </div>
                <div class="book-infos">
                    <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
                    <p class="author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                    <p class="sell-by">Vendu par : <?= htmlspecialchars($owners[$book->getId()]->getUsername()) ?></p>
                    <?php if ($book->getAvailable() === 'unavailable'): ?>
                        <span class="badge">non dispo.</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>