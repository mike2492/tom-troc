<header>
    <div class="container">
        <div class="left-group">
            <a href="">
                <img src="assets/images/logo.svg" alt="">
            </a>

            <nav>
                <a href="">Accueil</a>
                <a href="">Nos livres à l'échange</a>
            </nav>
        </div>

        <nav>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="index.php?controller=message&action=inbox">Messagerie</a>
                <a href="index.php?controller=user&action=account">Mon compte</a>
                <a href="index.php?controller=auth&action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login">Connexion</a>
            <?php endif; ?>
        </nav>
    </div>
</header>