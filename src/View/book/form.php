<?php $book = $book ?? null; ?>
<?php $currentAvailability = $book ? $book->getAvailability() : 'available'; ?>
<h1><?= htmlspecialchars($title) ?></h1>

<form method="POST">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" value="<?= $book ? htmlspecialchars($book->getTitle()) : '' ?>">

    <?php if(isset($errors['title'])): ?>
        <p><?= htmlspecialchars($errors['title']) ?></p>
    <?php endif; ?>

    <label for="author">Auteur</label>
    <input type="text" name="author" id="author" value="<?= $book ? htmlspecialchars($book->getAuthor()) : '' ?>">

    <?php if(isset($errors['author'])): ?>
        <p><?= htmlspecialchars($errors['author']) ?></p>
    <?php endif; ?>

    <label for="description">Commentaire</label>
    <textarea name="description" id="description"><?= $book ? htmlspecialchars($book->getAuthor()) : '' ?></textarea>

    <?php if(isset($errors['description'])): ?>
        <p><?= htmlspecialchars($errors['description']) ?></p>
    <?php endif; ?>

    <label for="availability">Disponibilité</label>
    <select name="availability" id="availability">
        <option value="available" <?= $currentAvailability === 'available' ? 'selected' : '' ?>>Disponible</option>
        <option value="unavailable" <?= $currentAvailability === 'unavailable' ? 'selected' : '' ?>>Non disponible</option>
    </select>

    <?php if(isset($errors['availability'])): ?>
        <p><?= htmlspecialchars($errors['availability']) ?></p>
    <?php endif; ?>

    <button type="submit">Valider</button>
</form>