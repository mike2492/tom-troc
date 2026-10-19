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

<h1><?= htmlspecialchars($user->getUsername()) ?></h1>

<p>Membre depuis : <?= $since ?></p>

<p>Bibliothèque</p>
<span><?= count($books) ?> livres</span>

<?php if(empty($books)): ?>
    <p>Aucun livre dans cette bibliothèque</p>
<?php else: ?>
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
                    <td></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 100)) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>