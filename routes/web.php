<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\EditionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('cards/fetch', [CardController::class, 'storeCardsFromAPI']);
Route::get('editions/fetch_sets', [EditionController::class, 'fetchSets']);
Route::get('editions/update_sets', [EditionController::class, 'updateSets']);

Route::middleware(['auth:sanctum', 'verified'])->resource('archives', ArchiveController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('decks', DeckController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('cards', CardController::class);

