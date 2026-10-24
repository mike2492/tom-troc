<section class="auth">
    <div class="auth__form">
        <h1>Inscription</h1>

        <div class="errors">
            <?php if(isset($errors['username'])): ?>
                <p class="error">* <?= $errors['username'] ?></p>
            <?php endif; ?>

            <?php if(isset($errors['password'])): ?>
                <p class="error">* <?= $errors['password'] ?></p>
            <?php endif; ?>

            <?php if(isset($errors['email'])): ?>
                <p class="error">* <?= $errors['email'] ?></p>
            <?php endif; ?>
        </div>

        <form action="" method="POST">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username">

            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            

            <button type="submit">S'inscrire</button>
        </form>

        <p class="no-account">Déjà inscrit ? <a href="index.php?controller=auth&action=login">Connectez-vous</a></p>
    </div>

    <div class="auth__image">
        <img src="images/bibliotheque-2.png" alt="">
    </div>
</section>