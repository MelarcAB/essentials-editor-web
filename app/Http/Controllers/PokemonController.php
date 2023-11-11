<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\PDO\Pokemon;
use App\PDO\Ability;

class PokemonController extends Controller
{
    function index(Request $request) {
        $pokemon_obj = new Pokemon();
        $allPokemons = $pokemon_obj->getData();
    
        // Convertir el array de objetos a una colección de Laravel
        $collection = new Collection($allPokemons);
    
        // Definir cuántos ítems quieres por página
        $perPage = 50;
    
        // Obtener la página actual desde la URL
        $currentPage = $request->input('page', 1);
    
        // Crear una nueva instancia de LengthAwarePaginator
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $pokemons = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage, $currentPage, ['path' => $request->url(), 'query' => $request->query()]);
    
        return view('pokemon.index', compact('pokemons'));
    }

    function show($name) {
        $name = strtoupper($name);
        $pokemon_obj = new Pokemon();
        $ability_obj = new Ability();
        $abilities = $ability_obj->getAbilities();
        $pokemon = $pokemon_obj->searchPokemon($name);
        if (!$pokemon) return;
        return view('pokemon.show', compact('pokemon','abilities'));
    }
    
}
