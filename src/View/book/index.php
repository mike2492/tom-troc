<h1><?= htmlspecialchars($title) ?></h1>

<?php foreach($books as $book): ?>
    <h2><?= htmlspecialchars($book->getTitle()) ?></h2>
    <p><?= htmlspecialchars($book->getAuthor()) ?></p>
    <p>Vendu par : <?= htmlspecialchars($owners[$book->getId()]) ?></p>
    <?php if($book->getStatus() === 'unavailable'): ?>
        <span>non dispo</span>
    <?php endif; ?>
<?php endforeach; ?>