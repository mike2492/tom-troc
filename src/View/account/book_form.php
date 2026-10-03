<form method="POST">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($book->getTitle()) ?>">

    <label for="author">Auteur</label>
    <input type="text" name="author" id="author" value="<?= htmlspecialchars($book->getAuthor()) ?>">
    
    <label for="description">Commentaire</label>
    <textarea name="description" id="description"><?= htmlspecialchars($book->getDescription()) ?></textarea>

    <label for="availability">Disponibilité</label>
    <select name="availability" id="availability">
       <option value="available" <?= $book->getAvailability() === 'available' ? 'selected' : '' ?>>Disponible</option>
       <option value="unavailable" <?= $book->getAvailability() === 'unavailable' ? 'selected' : '' ?>>Non disponible</option>
    </select>
    
    <button type="submit">Valider</button>
</form>