<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des jeux</title>
</head>
<body>

<h1>Liste des jeux</h1>

<a href="{{ route('games.create') }}">Ajouter un jeu</a>

<ul>
    @foreach ($games as $game)
        <li>
            <strong>{{ $game->title }}</strong><br>
            {{ $game->description }}<br>
            Sortie : {{ $game->release_date }}
        </li>
    @endforeach
</ul>
</body>
</html>
