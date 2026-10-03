<h1>Nos livres à l'échange</h1>

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