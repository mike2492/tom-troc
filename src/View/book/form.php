<h1><?= htmlspecialchars($title) ?></h1>

<form action="" method="POST" enctype="multipart/form-data">

    <div>
        <p>Photo</p>
        <label for="image">Modifier la photo</label>
        <input type="file" name="image" id="image">
    </div>

    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title">

        <label for="author">Auteur</label>
        <input type="text" name="author" id="author">

        <label for="description">Commentaire</label>
        <textarea name="description" id="description"></textarea>

        <label for="status">Disponibilité</label>

        <select name="status" id="status">
            <option value="available">Disponible</option>
            <option value="unavailable">Non disponible</option>
        </select>

        <button type="submit">Valider</button>
    </div>


</form>