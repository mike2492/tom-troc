<h1>Mon compte</h1>
<p><?= htmlspecialchars($user->getUsername()) ?></p>
<p></p>
<p>Membre depuis : <?= htmlspecialchars($user->getCreatedAt()) ?></p>