<section class="auth">
    <div class="auth__form">
        <h1>Inscription</h1>

        <form action="" method="POST">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username">
            <?php if(isset($errors['username'])): ?>
                <p><?= htmlspecialchars($errors['username']) ?></p>
            <?php endif; ?>

            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email">
            <?php if(isset($errors['email'])): ?>
                <p><?= htmlspecialchars($errors['email']) ?></p>
            <?php endif; ?>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            <?php if(isset($errors['password'])): ?>
                <p><?= htmlspecialchars($errors['password']) ?></p>
            <?php endif; ?>

            <button type="submit">S'inscrire</button>
        </form>

        <p class="no-account">Déjà inscrit ? <a href="index.php?controller=auth&action=login">Connectez-vous</a></p>
    </div>

    <div class="auth__image">
        <img src="images/bibliotheque-2.png" alt="">
    </div>
</section>