<?php // Edit form of a book. $book is always set here (BookController::edit only).?>
<section class="book-form">
    <div class="container">
        <a href="index.php?controller=account&action=index" class="book-form__back">← retour</a>
        <h1><?= htmlspecialchars($title) ?></h1>

        <div class="book-form__card">
            <div class="book-form__photo">
                <p class="book-form__label">Photo</p>
                <?php if (isset($book) && $book->getImage() !== null): ?>
                    <img src="uploads/books/<?= htmlspecialchars($book->getImage()) ?>" alt="">
                <?php else: ?>
                    <img src="https://picsum.photos/488/488" alt="">
                <?php endif; ?>
                <?php // Separate form: the photo is sent alone (multipart/form-data is required for files).?>
                <?php // The only line of JavaScript: onchange sends the form as soon as a file is chosen.?>
                <form action="" method="POST" enctype="multipart/form-data">
                     <label for="image">Modifier la photo</label>
                    <input type="file" name="image" id="image" onchange="this.form.submit()">
                </form>
            </div>

            <?php // Second form: the text fields. The controller tells them apart with $_FILES['image'].?>
            <form action="" method="POST" class="book-form__fields">

                <?php // All the errors (fields, photo, invalid form) are listed here.?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p class="error"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>

                <label for="title">Titre</label>
                <input type="text" name="title" id="title" value="<?= isset($book) ? htmlspecialchars($book->getTitle()) : '' ?>">
                

                <label for="author">Auteur</label>
                <input type="text" name="author" id="author" value="<?= isset($book) ? htmlspecialchars($book->getAuthor()) : '' ?>">
                
                <label for="description">Commentaire</label>
                <?php // No whitespace between the textarea tags: it would end up in the text.?>
                <textarea name="description" id="description"><?= isset($book) ? htmlspecialchars($book->getDescription()) : '' ?></textarea>
                

                <label for="status">Disponibilité</label>
                <select name="status" id="status">
                    <?php // Pre-select the current status. The values are checked again in the controller.?>
                    <option value="available" <?= isset($book) && $book->getStatus() === 'available' ? 'selected' : '' ?>>disponible</option>
                    <option value="unavailable" <?= isset($book) && $book->getStatus() === 'unavailable' ? 'selected' : '' ?>>non disponible</option>
                </select>

                <button type="submit">Valider</button>
            </form>
        </div>
    </div>
</section>