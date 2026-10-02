<h1>Connexion</h1>
<?php if(isset($errors['login'])): ?>
    <?= $errors['login']; ?>
<?php endif; ?>

<form action="index.php?controller=auth&action=login" method="POST">
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email">
    <?php if(isset($errors['email'])): ?>
        <?= $errors['email']; ?>
    <?php endif; ?>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <?php if(isset($errors['password'])): ?>
        <?= $errors['password']; ?>
    <?php endif; ?>

    <button type="submit">Se connecter</button>
</form>