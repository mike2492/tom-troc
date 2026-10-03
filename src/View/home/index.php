<h1>Salut</h1>

<?php foreach($books as $book): ?>
    <div class="book-card">
        <?= $book->getImage() ?>
        <?= $book->getTitle() ?>
        <?= $book->getAuthor() ?>
        <p>Vendu par : <?= $owners[$book->getUserId()]->getUsername() ?></p>
    </div>

<?php endforeach; ?>