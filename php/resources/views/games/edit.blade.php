<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un jeu</title>
</head>
<body>

<h1>Modifier un jeu</h1>

<form method="POST" action="{{ route('games.update', $game) }}">
    @csrf
    @method('PUT')

    <label>Titre</label><br>
    <input type="text" name="title" value="{{ $game->title }}"><br><br>

    <label>Description</label><br>
    <textarea name="description">{{ $game->description }}</textarea><br><br>

    <label>Date de sortie</label><br>
    <input type="date" name="release_date" value="{{ $game->release_date }}"><br><br>

    <button type="submit">Mettre à jour</button>
</form>

</body>
</html>
