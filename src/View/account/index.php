<p><?= $user->getUsername() ?></p>
<p><?= count($books) ?></p>

<form action="index.php?controller=account&action=updateProfile" method="POST">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" value="<?= $user->getEmail() ?>">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <label for="username">Pseudo</label>
    <input type="text" name="username" id="username" value="<?= $user->getUsername() ?>">

    <button type="submit">Enregistrer</button>
</form>

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
                        <a href="index.php?controller=account&action=editBook&id=<?= $book->getId() ?>">Editer</a>
                        <a href="index.php?controller=account&action=deleteBook&id=<?= $book->getId() ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>