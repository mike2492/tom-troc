<h1>Nos livres à l'échange</h1>

<form method="GET" action="index.php">
    <input type="hidden" name="controller" value="book">
    <input type="hidden" name="action" value="list">
    <input type="text" name="search" placeholder="Rechercher un livre" value="<?= htmlspecialchars($search ?? '') ?>">
    <button type="submit">Rechercher</button>
</form>

<div class="books-grid">
    <?php foreach ($books as $book): ?>
        <div class="book-card">
            <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
            <p><?= htmlspecialchars($book->getAuthor()) ?></p>
            <?php if ($book->getAvailable() === 'unavailable'): ?>
                <span class="badge">non dispo.</span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>