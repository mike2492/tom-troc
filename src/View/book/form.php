<h1><?= htmlspecialchars($title) ?></h1>

<form action="" method="POST" enctype="multipart/form-data">

    <div>
        <p>Photo</p>
        <label for="image">Modifier la photo</label>
        <input type="file" name="image" id="image">
    </div>

    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?= isset($book) ? htmlspecialchars($book->getTitle()) : '' ?>">
        <?php if(isset($errors['title'])): ?>
            <p><?= htmlspecialchars($errors['title']) ?></p>
        <?php endif; ?>

        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" value="<?= isset($book) ? htmlspecialchars($book->getAuthor()) : '' ?>">
        <?php if(isset($errors['author'])): ?>
            <p><?= htmlspecialchars($errors['author']) ?></p>
        <?php endif; ?>

        <label for="description">Commentaire</label>
        <textarea name="description" id="description"><?= isset($book) ? htmlspecialchars($book->getDescription()) : '' ?></textarea>
        <?php if(isset($errors['description'])): ?>
            <p><?= htmlspecialchars($errors['description']) ?></p>
        <?php endif; ?>

        <label for="status">Disponibilité</label>

        <select name="status" id="status">
            <option value="available" <?= isset($book) && $book->getStatus() === 'available' ? 'selected' : '' ?>>Disponible</option>
            <option value="unavailable" <?= isset($book) && $book->getStatus() === 'unavailable' ? 'selected' : '' ?>>Non disponible</option>
        </select>
        <?php if(isset($errors['status'])): ?>
            <p><?= htmlspecialchars($errors['status']) ?></p>
        <?php endif; ?>

        <button type="submit">Valider</button>
    </div>

</form>