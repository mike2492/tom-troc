<section class="auth">
    <div class="auth__form">
        <h1>Connexion</h1>
    
        <div class="errors">
            <?php foreach($errors as $error): ?>
                <p class="error">* <?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
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