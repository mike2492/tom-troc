<form action="index.php?controller=auth&action=register" method="POST">
    <label for="username">Pseudo</label>
    <input type="text" name="username" id="username">
    <?php if(isset($errors['username'])): ?>
        <?= $errors['username']; ?>
    <?php endif; ?>

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

    <button type="submit">S'inscrire</button>
</form>