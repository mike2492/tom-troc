<h1>Connexion</h1>
<?php if(isset($errors['login'])): ?>
    <p><?= htmlspecialchars($errors['login']) ?></p>
<?php endif; ?>

<form action="" method="POST">
    <label for="">Adresse email</label>
    <input type="email" name="email" id="email">
    <?php if(isset($errors['email'])): ?>
        <p><?= htmlspecialchars($errors['email']) ?></p>
    <?php endif; ?>


    <label for="">Mot de passe</label>
    <input type="password" name="password" id="password">
    <?php if(isset($errors['password'])): ?>
        <p><?= htmlspecialchars($errors['password']) ?></p>
    <?php endif; ?>

    <button type="submit">Se connecter</button>
</form>