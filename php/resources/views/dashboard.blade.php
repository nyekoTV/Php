<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Liste des jeux
                </h3>

                <a href="{{ route('games.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Ajouter un jeu
                </a>

                @if ($games->count())
                    <div class="space-y-4">
                        @foreach ($games as $game)
                            <div class="border rounded p-4 dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $game->title }}
                                </h4>

                                <p class="text-gray-700 dark:text-gray-300">
                                    {{ $game->description }}
                                </p>

                                <p class="text-sm text-gray-500 mt-2">
                                    Sortie : {{ $game->release_date }}
                                </p>
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
