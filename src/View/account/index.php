<h1>Mon compte</h1>
<p><?= htmlspecialchars($user->getUsername()) ?></p>
<p>Membre depuis : <?= htmlspecialchars($user->getCreatedAt()) ?></p>
<h2>Bibliothèque</h2>
<p><?= htmlspecialchars(count($books)) ?> livres</p>
<a href="index.php?controller=book&action=create">Ajouter un livre</a>


<form method="POST">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>">

    <?php if(isset($errors['email'])): ?>
        <p><?= htmlspecialchars($errors['email']) ?></p>
    <?php endif; ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" value="">

    <label for="username">Pseudo</label>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->getUsername()) ?>">

    <?php if(isset($errors['username'])): ?>
        <p><?= htmlspecialchars($errors['username']) ?></p>
    <?php endif; ?>

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
                    <td><img src="https://picsum.photos/78/78" alt=""></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td><?= htmlspecialchars(mb_strimwidth($book->getDescription(), 0, 80, '...')) ?></td>
                    <td>
                        <?php if($book->getAvailability() === 'available'): ?>
                            <span>disponible</span>
                        <?php else: ?>
                            <span>non dispo.</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?controller=book&action=edit&id=<?= $book->getId() ?>">Éditer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>