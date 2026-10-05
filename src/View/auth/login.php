<h1>Connexion</h1>

<?php if(isset($errors['login'])): ?>
    <p><?= htmlspecialchars($errors['login']); ?></p>
<?php endif; ?>

<form method="POST">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email">
    <?php if(isset($errors['email'])): ?>
        <p><?= htmlspecialchars($errors['email']); ?></p>
    <?php endif; ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <?php if(isset($errors['password'])): ?>
        <p><?= htmlspecialchars($errors['password']); ?></p>
    <?php endif; ?>

    <button type="submit">Se connecter</button>

    <p>Pas de compte ? <a href="index.php?controller=auth&action=register">Inscrivez vous</a></p>
</form>