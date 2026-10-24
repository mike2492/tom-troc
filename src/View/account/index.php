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

<section class="account">
    <div class="container">
        <h1>Mon compte</h1>

        <div class="account__top">
            <div class="account__card">
                <div class="account-img">
                    <img src="https://picsum.photos/135/135" alt="">
                    <a href="">modifier</a>
                </div>
                
                <hr>

                <div class="account-info">
                    <p class="info-username"><?= htmlspecialchars($user->getUsername()) ?></p>
                    <p class="info-since">Membre depuis <?= $since ?></p>
                    <p class="info-library">Bibliothèque</p>
                    <span class="info-books"><?= count($books) ?> livres</span>
                </div>
            </div>

            <div class="account__form">

            
                <h2>Vos informations personnelles</h2>

                <div class="errors">
                    <?php if(isset($errors['email'])): ?>
                        <p class="error">* <?= $errors['email'] ?></p>
                    <?php endif; ?>

                    <?php if(isset($errors['username'])): ?>
                        <p class="error">* <?= $errors['username'] ?></p>
                    <?php endif; ?>
                </div>

                <form action="" method="POST">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>">

                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password">

                    <label for="username">Pseudo</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->getUsername()) ?>">

                    <div class="account-btn">
                        <button type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

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
                        <td class="italic-description"><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 100)) ?><?= mb_strlen($book->getDescription()) > 100 ? '...' : '' ?></td>
                        <td>
                            <?php if($book->getStatus() === 'available'): ?>
                                <span class="dispo">disponible</span>
                            <?php else: ?>
                                <span class="no-dispo">non dispo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?controller=book&action=edit&id=<?= $book->getId() ?>" class="edit-link">Editer</a>
                            <a href="index.php?controller=book&action=delete&id=<?= $book->getId() ?>" class="delete-link">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>