<?php
// Public profile of a member: card with his info and the list of his books.

// "Member since": same calculation as on the account page.
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

<section class="account-public">
    <div class="container public-row">
        <div class="account__card">
            <div class="account-img">
                <?php // Uploaded avatar if any, otherwise a placeholder.?>
                <?php if ($user->getAvatar() !== null): ?>
                    <img src="uploads/avatars/<?= htmlspecialchars($user->getAvatar()) ?>" alt="" class="table-img">
                <?php else: ?>
                    <img src="https://picsum.photos/135/135" alt="">
                <?php endif; ?>
            </div>

            <hr>

             <div class="account-info">
                <p class="info-username"><?= htmlspecialchars($user->getUsername()) ?></p>
                <p class="info-since">Membre depuis <?= $since ?></p>
                <p class="info-library">Bibliothèque</p>
                <span class="info-books"><img src="images/book.svg" alt=""><?= count($books) ?> livres</span>
                <?php // Opens the conversation with this member.?>
                <a href="index.php?controller=message&action=index&id=<?= $user->getId() ?>">Ecrire un message</a>
            </div>
        </div>

        <?php // Same table as on the account page, without availability and actions.?>
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
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <?php if ($book->getImage() !== null): ?>
                                <img class="table-img" src="uploads/books/<?= htmlspecialchars($book->getImage()) ?>" alt="">
                            <?php else: ?>
                                <img src="https://picsum.photos/78/78" alt="">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($book->getTitle()) ?></td>
                        <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                        <td class="italic-description"><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 100)) ?><?= mb_strlen($book->getDescription()) > 100 ? '...' : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</section>