<?php
$interval = (new DateTimeImmutable($user->getCreatedAt()))->diff(new DateTimeImmutable());

if($interval->y >= 1){
    $since = $interval->y . ($interval->y > 1 ? ' ans' : ' an');
} elseif($interval->m >= 1){
    $since = $interval->m . ' mois';
} elseif($interval->d >= 1){
    $since = $interval->d . ($interval->d > 1 ? ' jours' : ' jour');
} else{
    $since = "moins d'un jour";
}
?>

<h1>Mon compte</h1>

<p><?= htmlspecialchars($user->getUsername()) ?></p>
<p>Membre depuis <?= $since ?></p>
<p>Bibliothèque</p>
<span><?= count($books) ?> livres</span>

<h2>Vos informations personnelles</h2>

<form action="" method="POST">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>">
    

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">

    <label for="username">Pseudo</label>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->getUsername()) ?>">
    
    <button type="submit">Enregistrer</button>
</form>

<?php if(empty($books)): ?>
    <p>Aucun livre dans votre bibliothèque</p>
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
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 100)) ?></td>
                    <td>
                        <?php if($book->getStatus() === 'available'): ?>
                            <span>disponible</span>
                        <?php else: ?>
                            <span>non dispo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="">Editer</a>
                        <a href="">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>