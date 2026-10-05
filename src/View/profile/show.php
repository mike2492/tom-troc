<h1><?= htmlspecialchars($profileUser->getUsername()) ?></h1>
<p>Membre depuis <?= htmlspecialchars($profileUser->getCreatedAt())?></p>
<p><?= count($books) ?> livres</p>
<a href="index.php?controller=message&action=thread&user=<?= $profileUser->getId() ?>">Ecrire un message</a>

<?php if(empty($books)): ?>
    <p>Aucun livre pour le moment</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($books as $book): ?>
                <tr>
                    <td><img src="https://picsum.photos/78/78" alt=""></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td><?= htmlspecialchars(mb_strimwidth($book->getDescription(), 0, 80, '...')) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>