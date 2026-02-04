<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un jeu</title>
</head>
<body>

<h1>Ajouter un jeu</h1>

<form method="POST" action="{{ route('games.store') }}">
    @csrf

    <label>Titre</label><br>
    <input type="text" name="title"><br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Date de sortie</label><br>
    <input type="date" name="release_date"><br><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
