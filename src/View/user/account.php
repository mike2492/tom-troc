<h1>Mon compte</h1>


<h2>Vos informations personnelles</h2>

<form method="POST" action="index.php?controller=user&action=account">
    <label>Adresse email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>">

    <label>Mot de passe</label>
    <input type="password" name="password" placeholder="Laisser vide pour ne pas changer">

    <label>Pseudo</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user->getUsername()) ?>">

    <?php if(!empty($errors)): ?>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <button type="submit">Enregistrer</button>
</form>

<h2>Bibliothèque</h2>

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
                <td><?= $book->getImage() ? '<img src="' . htmlspecialchars($book->getImage()) . '">' : '' ?></td>
                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                <td><?= htmlspecialchars(substr($book->getDescription(), 0, 50)) ?>...</td>
                <td><?= $book->getAvailable() === 'available' ? 'disponible' : 'non dispo.' ?></td>
                <td>
                    <a href="index.php?controller=book&action=edit&id=<?= $book->getId() ?>">Éditer</a>
                    <a href="index.php?controller=book&action=delete&id=<?= $book->getId() ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>