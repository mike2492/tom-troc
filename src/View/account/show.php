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

<section class="account-public">
    <div class="container public-row">
        <div class="account__card">
            <div class="account-img">
                <img src="https://picsum.photos/135/135" alt="">
            </div>

            <hr>

             <div class="account-info">
                <p class="info-username"><?= htmlspecialchars($user->getUsername()) ?></p>
                <p class="info-since">Membre depuis <?= $since ?></p>
                <p class="info-library">Bibliothèque</p>
                <span class="info-books"><img src="images/book.svg" alt=""><?= count($books) ?> livres</span>
                <a href="index.php?controller=message&action=index&id=<?= $user->getId() ?>">Ecrire un message</a>
            </div>
        </div>

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
                        <td class="italic-description"><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 100)) ?><?= mb_strlen($book->getDescription()) > 100 ? '...' : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</section>