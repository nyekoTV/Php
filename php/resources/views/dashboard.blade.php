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

                {{-- STATS --}}
                <div class="flex gap-4 mb-6">
                    <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded">
                        Jeux : <strong>{{ $gamesCount }}</strong>
                    </div>

                    <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded">
                        Utilisateurs : <strong>{{ $usersCount }}</strong>
                    </div>
                </div>

                <a href="{{ route('games.create') }}"
                   class="inline-block mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Ajouter un jeu
                </a>

                @forelse ($games as $game)
                    <div class="border rounded p-4 mb-4 dark:border-gray-700">

                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $game->title }}
                        </h4>

                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $game->description }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Sortie : {{ $game->release_date }}
                        </p>

                        {{-- ACTIONS : SEULEMENT POUR LE PROPRIÉTAIRE --}}
                        @if ($game->user_id === auth()->id())
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

                    </div>
                @empty
                    <p class="text-gray-500">
                        Aucun jeu pour le moment.
                    </p>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>
