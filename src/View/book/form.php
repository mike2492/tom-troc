<section class="book-form">
    <div class="container">
        <a href="index.php?controller=account&action=index" class="book-form__back">← retour</a>
        <h1><?= htmlspecialchars($title) ?></h1>

        <div class="book-form__card">
            <div class="book-form__photo">
                <p class="book-form__label">Photo</p>
                <?php if(isset($book) && $book->getImage() !== null): ?>
                    <img src="uploads/books/<?= htmlspecialchars($book->getImage()) ?>" alt="">
                <?php else: ?>
                    <img src="https://picsum.photos/488/488" alt="">
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                     <label for="image">Modifier la photo</label>
                    <input type="file" name="image" id="image" onchange="this.form.submit()">
                </form>
            </div>

            <form action="" method="POST" class="book-form__fields">

                <div class="errors">
                    <?php foreach($errors as $error): ?>
                        <p class="error"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>

                <label for="title">Titre</label>
                <input type="text" name="title" id="title" value="<?= isset($book) ? htmlspecialchars($book->getTitle()) : '' ?>">
                

                <label for="author">Auteur</label>
                <input type="text" name="author" id="author" value="<?= isset($book) ? htmlspecialchars($book->getAuthor()) : '' ?>">
                
                <label for="description">Commentaire</label>
                <textarea name="description" id="description"><?= isset($book) ? htmlspecialchars($book->getDescription()) : '' ?></textarea>
                

                <label for="status">Disponibilité</label>
                <select name="status" id="status">
                    <option value="available" <?= isset($book) && $book->getStatus() === 'available' ? 'selected' : '' ?>>disponible</option>
                    <option value="unavailable" <?= isset($book) && $book->getStatus() === 'unavailable' ? 'selected' : '' ?>>non disponible</option>
                </select>

                <button type="submit">Valider</button>
            </form>
        </div>
    </div>
</section>