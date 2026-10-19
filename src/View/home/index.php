<section class="hero-section">
    <div class="container hero">
        <div class="hero-text">
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
            <a href="index.php?controller=book&action=index">Découvrir</a>
        </div>
        <div class="hero__image">
            <img src="images/bibliotheque.png" alt="">
        </div>
    </div>
</section>


<section class="latest-books">
    <div class="container">
        <h2>Les derniers livres ajoutés</h2>
        <div class="books-list">
            <?php foreach($books as $book): ?>
                <a href="index.php?controller=book&action=show&id=<?= $book->getId() ?>">
                    <div class="book-card">
                        <img src="https://picsum.photos/200/200" alt="">
                        <h3 class="book-title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                        <p class="book-author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <p class="book-owner">Vendu par : <?= htmlspecialchars($owners[$book->getId()]) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="books-action">
            <a href="index.php?controller=book&action=index" class="btn-books">Voir tous les livres</a>
        </div>
    </div>
</section>


<section class="how-it-works">
    <div class="container">
        <h2>Comment ça marche ?</h2>
        <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>

        <div class="steps">
            <div class="step"><p>Inscrivez-vous gratuitement sur 
            notre plateforme</p></div>
            <div class="step"><p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p></div>
            <div class="step"><p>Parcourez les livres disponibles chez d'autres membres.</p></div>
            <div class="step"><p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p></div>
        </div>

        <div class="books-action">
            <a href="index.php?controller=book&action=index" class="btn-books-2">Voir tous les livres</a>
        </div>
    </div>
</section>

<section class="banner">
    <img src="images/banner.png" alt="">
</section>

<section class="values">
    <div class="container values-content">
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <p class="team-tomtroc">L'équipe Tom Troc</p>
        <div class="values-img">
             <img src="images/heart.svg" alt="">
        </div>
    </div>
</section>