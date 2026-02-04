<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Liste des jeux
                </h3>

                {{-- STATS (ADMIN ONLY) --}}
@if(auth()->user()->is_admin)
    <div class="flex gap-4 mb-6">
        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded">
            Jeux : <strong>{{ $gamesCount }}</strong>
        </div>

        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded">
            Utilisateurs : <strong>{{ $usersCount }}</strong>
        </div>
    </div>
@endif


                <a href="{{ route('games.create') }}"
                   class="inline-block mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Ajouter un jeu
                </a>

                @forelse ($games as $game)
                    <div class="border rounded p-4 mb-6 dark:border-gray-700">

                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $game->title }}
                        </h4>

                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $game->description }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Sortie : {{ $game->release_date }}
                        </p>

                        {{-- ACTIONS : PROPRIÉTAIRE OU ADMIN --}}
                        @if ($game->user_id === auth()->id() || auth()->user()->is_admin)
                            <div class="mt-4 flex gap-3">
                                <a href="{{ route('games.edit', $game) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Modifier
                                </a>

                                <form method="POST"
                                      action="{{ route('games.destroy', $game) }}"
                                      onsubmit="return confirm('Supprimer ce jeu ?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif

                        {{-- COMMENTS --}}
                        <div class="mt-6 border-t pt-4 dark:border-gray-600">
                            <h5 class="font-semibold text-sm text-gray-300">
                                Commentaires
                            </h5>

                            @foreach ($game->comments as $comment)
                                <div class="text-sm text-gray-400 mt-2">
                                    <strong>{{ $comment->user->name }}</strong> :
                                    {{ $comment->content }}

                                    @if ($comment->user_id === auth()->id() || auth()->user()->is_admin)
                                        <form method="POST"
                                              action="{{ route('comments.destroy', $comment) }}"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 ml-2">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach

                            {{-- ADD COMMENT --}}
                            <form method="POST"
                                  action="{{ route('comments.store', $game) }}"
                                  class="mt-3">
                                @csrf
                                <input type="text"
                                       name="content"
                                       class="w-full rounded bg-gray-700 text-white p-2"
                                       placeholder="Ajouter un commentaire">
                                <button
                                    class="mt-2 px-3 py-1 bg-blue-600 text-white rounded">
                                    Envoyer
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <p class="text-gray-500">
                        Aucun jeu pour le moment.
                    </p>
                @endforelse

                {{-- PAGINATION --}}
                <div class="mt-6">
                    {{ $games->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
