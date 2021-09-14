<?php

use App\Http\Controllers\ArchiveCardController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\EditionController;
use App\Models\Card;
use App\Models\Archive;
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


Route::get('cards/fetch', [CardController::class, 'storeCardsFromAPI']);
Route::get('editions/fetch_sets', [EditionController::class, 'fetchSets']);
Route::get('editions/update_sets', [EditionController::class, 'updateSets']);


///////////////////////////////////
// New Routes
///////////////////////////////////

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::view('/dashboard', 'dashboard')->name('dashboard');

/*******************************************************
 *        Archive Routes
********************************************************/
    Route::resource('archives', ArchiveController::class)->scoped([
        'archive' => 'slug',
    ]);

/*******************************************************
 *        Deck Routes
********************************************************/
    Route::resource('decks', DeckController::class)->scoped([
        'deck' => 'slug',
    ]);

/*******************************************************
 *        Single Card Routes
********************************************************/
    Route::resource('cards', DeckController::class)
        ->except(['create', 'edit', 'update']);


/*******************************************************
 *        Archive Cards Routes
********************************************************/
    Route::get('archives/{archive:slug}/cards/{scryfall_id}', [ArchiveCardController::class, 'show'])
        ->middleware(['updateDB'])
        ->name('archives.cards.show');

    Route::get('archives/{archive:slug}/cards', [ArchiveController::class, 'show'])
        ->middleware(['updateDB'])
        ->name('archives.cards.index');
});
