<h1>Mon compte</h1>
<p><?= htmlspecialchars($user->getUsername()) ?></p>
<p></p>
<p>Membre depuis : <?= htmlspecialchars($user->getCreatedAt()) ?></p>


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