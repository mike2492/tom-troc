<section class="auth">
    <div class="auth__form">
        <h1>Connexion</h1>
    
        <div class="errors">
            <?php if(isset($errors['login'])): ?>
                <p class="error">* <?= $errors['login'] ?></p>
            <?php endif; ?>

            <?php if(isset($errors['email'])): ?>
                <p class="error">* <?= $errors['email'] ?></p>
            <?php endif; ?>

            <?php if(isset($errors['password'])): ?>
                <p class="error">* <?= $errors['password'] ?></p>
            <?php endif; ?>
        </div>

        <form action="" method="POST">
            <label for="email">Adresse email</label>
            <input type="email" name="email" id="email">
            

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">

            <button type="submit">Se connecter</button>
        </form>

        <p class="no-account">Pas de compte ? <a href="index.php?controller=auth&action=register">Inscrivez-vous</a></p>
    </div>

    <div class="auth__image">
        <img src="images/bibliotheque-2.png" alt="">
    </div>
</section>