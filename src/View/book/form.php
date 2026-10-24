<section class="book-form">
    <div class="container">
        <a href="index.php?controller=account&action=index" class="book-form__back">← retour</a>
        <h1><?= htmlspecialchars($title) ?></h1>

        <form action="" method="POST" enctype="multipart/form-data" class="book-form__card">
            <div class="book-form__photo">
                <p class="book-form__label">Photo</p>
                <img src="https://picsum.photos/488/488" alt="">
                <label for="image">Modifier la photo</label>
                <input type="file" name="image" id="image">
            </div>

            <div class="book-form__fields">

                <div class="errors">
                    <?php if(isset($errors['title'])): ?>
                        <p class="error">* <?= $errors['title'] ?></p>
                    <?php endif; ?>

                    <?php if(isset($errors['author'])): ?>
                        <p class="error">* <?= $errors['author'] ?></p>
                    <?php endif; ?>

                    <?php if(isset($errors['description'])): ?>
                        <p class="error">* <?= $errors['description'] ?></p>
                    <?php endif; ?>

                    <?php if(isset($errors['status'])): ?>
                        <p class="error">* <?= $errors['status'] ?></p>
                    <?php endif; ?>
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
            </div>
        </form>
    </div>
</section>