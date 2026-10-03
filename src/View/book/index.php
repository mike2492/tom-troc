<h1>Nos livres à l'échange</h1>

<form method="GET">
    <input type="hidden" name="controller" value="book">
    <input type="hidden" name="action" value="index">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Rechercher un livre">
</form>

<?php foreach($books as $book): ?>
    <div class="book-card">
        <?= $book->getImage() ?>
        <?php if($book->getAvailability() === 'unavailable'): ?>
            <span>non dispo</span>
        <?php endif; ?>
        <?= $book->getTitle() ?>
        <?= $book->getAuthor() ?>
        <?= $owners[$book->getUserId()]->getUsername() ?>
    </div>
<?php endforeach; ?>