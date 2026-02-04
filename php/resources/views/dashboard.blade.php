<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        Liste des jeux
                    </h3>

                    <a href="{{ route('games.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Ajouter un jeu
                    </a>
                </div>

                @if ($games->count())

                    <div class="space-y-4">
                        @foreach ($games as $game)

                            <div class="border rounded p-4 dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $game->title }}
                                </h4>

                                <p class="text-gray-700 dark:text-gray-300 mt-1">
                                    {{ $game->description }}
                                </p>

                                <p class="text-sm text-gray-500 mt-2">
                                    Sortie : {{ $game->release_date }}
                                </p>

                                {{-- ACTIONS --}}
                                <div class="mt-4 flex gap-2">

                                    {{-- Modifier --}}
                                    @can('update', $game)
                                        <a href="{{ route('games.edit', $game) }}"
                                           class="px-3 py-1 bg-yellow-500 text-black rounded hover:bg-yellow-600">
                                            Modifier
                                        </a>
                                    @endcan

                                    {{-- Supprimer --}}
                                    @can('delete', $game)
                                        <form action="{{ route('games.destroy', $game) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce jeu ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                            </div>

                        @endforeach
                    </div>

                @else
                    <p class="text-gray-500">
                        Aucun jeu pour le moment.
                    </p>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
