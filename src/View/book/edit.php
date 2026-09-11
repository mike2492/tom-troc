<h1>Modifier les informations</h1>

<form method="POST" action="index.php?controller=book&action=save">
    <input type="hidden" name="id" value="<?= $book !== null ? $book->getId() : '' ?>">

    <label>Titre</label>
    <input type="text" name="title" value="<?= htmlspecialchars($book !== null ? $book->getTitle() : '') ?>">

    <label>Auteur</label>
    <input type="text" name="author" value="<?= htmlspecialchars($book !== null ? $book->getAuthor() : '') ?>">

    <label>Commentaire</label>
    <textarea name="description"><?= htmlspecialchars($book !== null ? $book->getDescription() : '') ?></textarea>

    <label>Disponibilité</label>
    <select name="available">
        <option value="available" <?= ($book !== null && $book->getAvailable() === 'available') ? 'selected' : '' ?>>disponible</option>
        <option value="unavailable" <?= ($book !== null && $book->getAvailable() === 'unavailable') ? 'selected' : '' ?>>non disponible</option>
    </select>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <button type="submit">Valider</button>
</form>