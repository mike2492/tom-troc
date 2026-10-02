<p><?= $user->getUsername() ?></p>
<p><?= count($books) ?></p>

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
                <th>Disponibilité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($books as $book): ?>
                <tr>
                    <td></td>
                    <td><?= $book->getTitle() ?></td>
                    <td><?= $book->getAuthor() ?></td>
                    <td><?= mb_strimwidth($book->getDescription(), 0, 80, '...') ?></td>
                    <td>
                        <?php if($book->getAvailability() === 'available'): ?>
                            Disponible
                        <?php else: ?>
                            Non dispo
                        <?php endif; ?>
                    </td>
                    <td>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>