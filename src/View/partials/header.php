<header class="header">
    <div class="header__inner container">
        <div class="header__left">
            <a href="index.php"><img src="images/logo.svg" alt="Tom Troc"></a>
            <nav class="header__nav">
                <a href="index.php">Accueil</a>
                <a href="index.php?controller=book&action=index">Nos livres à l'échange</a>
            </nav>
        </div>

        <nav class="header__account">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="index.php?controller=message&action=index"><span>
                    <img src="images/icon-message.png" alt="">
                </span>Messagerie</a>
                <a href="index.php?controller=account&action=index"><span>
                    <img src="images/icon-account.png" alt="">
                </span>Mon compte</a>
                <a href="index.php?controller=auth&action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login">Connexion</a>
            <?php endif; ?>
        </nav>
    </div>
</header>