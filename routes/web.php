<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\ItemsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
});

/**
 * MetadataController
 * /metadata
 */

Route::get('/metadata', [MetadataController::class, 'index'])->name('metadata.index');
Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');
