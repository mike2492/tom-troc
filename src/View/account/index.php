<?php
// "Mon compte": the logged-in member's profile, personal information and books.

// "Member since": difference between the sign-up date and now,
// shown in the largest unit that applies (years, months, days).
$interval = (new DateTimeImmutable($user->getCreatedAt()))->diff(new DateTimeImmutable());

if ($interval->y >= 1) {
    $since = $interval->y . ($interval->y > 1 ? ' ans' : ' an');
} elseif ($interval->m >= 1) {
    $since = $interval->m . ' mois';
} elseif ($interval->d >= 1) {
    $since = $interval->d . ($interval->d > 1 ? ' jours' : ' jour');
} else {
    $since = "moins d'un jour";
}
?>

<section class="account">
    <div class="container">
        <h1>Mon compte</h1>

        <div class="account__top">
            <div class="account__card">
                <div class="account-img">
                    <?php // Uploaded avatar if any, otherwise a placeholder.?>
                    <?php if ($user->getAvatar() !== null): ?>
                        <img src="uploads/avatars/<?= htmlspecialchars($user->getAvatar()) ?>" alt="">
                    <?php else: ?>
                        <img src="https://picsum.photos/135/135" alt="">
                    <?php endif; ?>
                    <?php // First form: the avatar alone (multipart/form-data is required for files).?>
                    <?php // The only line of JavaScript: onchange sends the form as soon as a file is chosen.?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="avatar">modifier</label>
                        <input type="file" name="avatar" id="avatar" onchange="this.form.submit()">
                    </form>
                    
                </div>
                
                <hr>

                <div class="account-info">
                    <p class="info-username"><?= htmlspecialchars($user->getUsername()) ?></p>
                    <p class="info-since">Membre depuis <?= $since ?></p>
                    <p class="info-library">Bibliothèque</p>
                    <span class="info-books"><img src="images/book.svg" alt=""><?= count($books) ?> livres</span>
                </div>
            </div>

            <div class="account__form">

            
                <h2>Vos informations personnelles</h2>

                <?php // All the errors (fields, avatar, invalid form) are listed here.?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p class="error">* <?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>

                <?php // Second form: text information. The controller tells the two forms apart with $_FILES['avatar'].?>
                <form action="" method="POST">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>">

                    <?php // Left empty on purpose: an empty password means "keep the current one".?>
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

        <?php // The member's own books, with edit and delete links.?>
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
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <?php // Uploaded photo if any, otherwise a placeholder.?>
                            <?php if ($book->getImage() !== null): ?>
                                <img src="uploads/books/<?= htmlspecialchars($book->getImage()) ?>" alt="" class="table-img">
                            <?php else: ?>
                                <img src="https://picsum.photos/78/78" alt="">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($book->getTitle()) ?></td>
                        <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                        <?php // Preview of the description: first 100 characters, "..." only if it was cut.?>
                        <td class="italic-description"><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 100)) ?><?= mb_strlen($book->getDescription()) > 100 ? '...' : '' ?></td>
                        <td>
                            <?php if ($book->getStatus() === 'available'): ?>
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