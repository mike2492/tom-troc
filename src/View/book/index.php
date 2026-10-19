<h1><?= htmlspecialchars($title) ?></h1>

<form action="" method="GET">
    <input type="hidden" name="controller" value="book">
    <input type="hidden" name="action" value="index">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Rechercher un livre">
    <button type="submit">Rechercher</button>
</form>

<?php foreach($books as $book): ?>
    <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
    <p><?= htmlspecialchars($book->getAuthor()) ?></p>
    <p>Vendu par : <?= htmlspecialchars($owners[$book->getId()]) ?></p>
    <?php if($book->getStatus() === 'unavailable'): ?>
        <span>non dispo</span>
    <?php endif; ?>
<?php endforeach; ?>