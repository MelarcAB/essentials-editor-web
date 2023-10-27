@extends('app')

@section('content')
<div class="bg-gray-100 min-h-screen px-4 py-8">
    <div class="max-w-6xl mx-auto">

        <!-- Botón "Nuevo" -->
        <div class="mb-6 text-center">
            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full shadow-lg">
                Nuevo
            </a>
        </div>

        <!-- Listado de Pokémon -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg divide-y divide-gray-200">
             <!-- Paginación y detalles -->
             <div class="mt-6 px-4 py-3 flex items-center justify-between">
                {{ $pokemons->links() }}
                <div class="text-sm">
                    Mostrando {{ $pokemons->firstItem() }}-{{ $pokemons->lastItem() }} de {{ $pokemons->total() }} resultados. Página {{ $pokemons->currentPage() }} de {{ $pokemons->lastPage() }}.
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($pokemons as $pokemon)
                    <div class="p-4 hover:bg-gray-50 flex">
                        <img src="{{ asset($pokemon->getSprites()['front']) }}" alt="sprite" class="w-24 h-24 rounded-full shadow-md border-2 border-blue-500 mr-4">
                        <div>
                            <h2 class="text-xl font-bold mb-2">{{ $pokemon->Name }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                <div><strong>Types:</strong> {{ $pokemon->Types }}</div>
                                <div><strong>BaseStats:</strong> {{ $pokemon->BaseStats }}</div>
                                <div><strong>GenderRatio:</strong> {{ $pokemon->GenderRatio }}</div>
                                <div><strong>GrowthRate:</strong> {{ $pokemon->GrowthRate }}</div>
                                <!-- Additional Fields -->
                                <div><strong>Height:</strong> {{ $pokemon->Height }} m</div>
                                <div><strong>Weight:</strong> {{ $pokemon->Weight }} kg</div>
                                <div><strong>Category:</strong> {{ $pokemon->Category }}</div>
                                <div><strong>Pokedex:</strong> {{ $pokemon->Pokedex }}</div>
                            </div>

                            <!-- Botón "Editar" -->
                            <div class="mt-4 text-right">
                                <a href="{{route('pokemon.show',['name'=>$pokemon->getPokemonName(true)])}}" class="text-blue-600 hover:text-blue-700 font-bold py-1 px-3 border border-blue-600 hover:border-blue-700 rounded-full">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación y detalles -->
            <div class="mt-6 px-4 py-3 flex items-center justify-between">
                {{ $pokemons->links() }}
                <div class="text-sm">
                    Mostrando {{ $pokemons->firstItem() }}-{{ $pokemons->lastItem() }} de {{ $pokemons->total() }} resultados. Página {{ $pokemons->currentPage() }} de {{ $pokemons->lastPage() }}.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
