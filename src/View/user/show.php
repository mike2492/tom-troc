<p><?= $user->getUsername() ?></p>
<p><?= $user->getCreatedAt()->diff(new DateTime())->format('%d an(s)') ?></p>
<p><?= count($books) ?></p>
<a href="index.php?controller=message&action=index&user=<?= $user->getId() ?>">Envoyer un message</a>

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
                <td><?= $book->getImage() ?></td>
                <td><?= $book->getTitle() ?></td>
                <td><?= $book->getAuthor() ?></td>
                <td><?= $book->getDescription() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>