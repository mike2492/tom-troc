<form method="POST">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title">

    <label for="author">Auteur</label>
    <input type="text" name="author" id="author">
    
    <label for="description">Commentaire</label>
    <textarea name="description" id="description"></textarea>

    <label for="availability">Disponibilité</label>
    <select name="availability" id="availability">
        <option value="available">Disponible</option>
        <option value="unavailable">Non disponible</option>
    </select>
    
    <button type="submit">Valider</button>
</form>