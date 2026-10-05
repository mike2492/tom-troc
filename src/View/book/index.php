<h1>Nos livres à l'échange</h1>

<?php if(empty($books)): ?>
    <p>Aucun livre pour le moment</p>
<?php else: ?>
    <?php foreach($books as $book): ?>
        <a href="index.php?controller=book&action=show&id=<?= $book->getId() ?>">
            <div class="box-card">
                <img src="https://picsum.photos/200/200" alt="">
                <p><?= htmlspecialchars($book->getTitle()) ?></p>
                <p><?= htmlspecialchars($book->getAuthor()) ?></p>
                <p>Vendu par : <?= htmlspecialchars($owners[$book->getUserId()]->getUsername()) ?></p>
                <?php if($book->getAvailability() === 'unavailable'): ?>
                    <span>non dispo.</span>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>