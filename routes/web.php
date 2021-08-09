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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('cards/fetch', [CardController::class, 'storeCardsFromAPI']);
Route::get('editions/fetch_sets', [EditionController::class, 'fetchSets']);
Route::get('editions/update_sets', [EditionController::class, 'updateSets']);


/******************************************************* 
 *        Archive Routes
********************************************************/
//Route::middleware(['auth:sanctum', 'verified'])->resource('archives', ArchiveController::class);
Route::middleware(['auth:sanctum', 'verified'])
    ->get('archives', [ArchiveController::class, 'index'])
    ->name('archives.index');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('archives/create', [ArchiveController::class, 'create'])
    ->name('archives.create');
Route::middleware(['auth:sanctum', 'verified'])
    ->post('archives', [ArchiveController::class, 'store'])
    ->name('archives.store');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('archives/{archive:slug}', [ArchiveController::class, 'show'])
    ->missing(function(){ return redirect()->route('archives.index'); })
    ->name('archives.show');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('archives/{archive:slug}/edit', [ArchiveController::class, 'edit'])
    ->name('archives.edit');
Route::middleware(['auth:sanctum', 'verified'])
    ->put('archives/{archive:slug}', [ArchiveController::class, 'update'])
    ->name('archives.update');
Route::middleware(['auth:sanctum', 'verified'])
    ->delete('archives/{archive:slug}', [ArchiveController::class, 'delete'])
    ->name('archives.delete');


/******************************************************* 
 *        Deck Routes
********************************************************/
//Route::middleware(['auth:sanctum', 'verified'])->resource('decks', DeckController::class);
Route::middleware(['auth:sanctum', 'verified'])
    ->get('decks', [DeckController::class, 'index'])
    ->name('decks.index');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('decks/create', [DeckController::class, 'create'])
    ->name('decks.create');
Route::middleware(['auth:sanctum', 'verified'])
    ->post('decks', [DeckController::class, 'store'])
    ->name('decks.store');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('decks/{deck:slug}', [DeckController::class, 'show'])
    ->name('decks.show');
Route::middleware(['auth:sanctum', 'verified'])
    ->get('decks/{deck:slug}/edit', [DeckController::class, 'edit'])
    ->name('decks.edit');
Route::middleware(['auth:sanctum', 'verified'])
    ->put('decks/{deck:slug}', [DeckController::class, 'update'])
    ->name('decks.update');
Route::middleware(['auth:sanctum', 'verified'])
    ->delete('decks/{deck:slug}', [DeckController::class, 'delete'])
    ->name('decks.delete');


/******************************************************* 
 *        Archive Card Routes
********************************************************/
//Route::middleware(['auth:sanctum', 'verified'])->resource('archives.cards', ArchiveCardController::class);
Route::middleware(['auth:sanctum', 'verified'])
    ->get('archives/{archive:slug}/cards', [ArchiveController::class, 'show'])
    ->missing(function(){ return redirect()->route('archives.index'); })
    ->name('archives.cards.index');
//Route::middleware(['auth:sanctum', 'verified'])->get('archives/{archive:slug}/cards/create', [ArchiveCardController::class, 'create'])->name('archives.cards.create');
Route::middleware(['auth:sanctum', 'verified'])
    ->post('archives/{archive:slug}/cards/{card:scryfall_id}', [ArchiveCardController::class, 'store'])
    ->missing(function(){ return redirect()->route('archives.cards.index'); })
    ->name('archives.cards.store');
Route::middleware(['auth:sanctum', 'verified'])
    //->get('archives/{archive:slug}/cards/{card:oracle_id}', [ArchiveCardController::class, 'show'])
    ->get('archives/{archive:slug}/cards/{card:oracle_id}', function( $archive,  $card){
        ddd([$archive, $card]);
    })
    ->missing(function(){ return redirect()->route('archives.cards.index'); })
    ->name('archives.cards.show');
//Route::middleware(['auth:sanctum', 'verified'])->get('archives/{archive:slug}/cards/{card:oracle_id}/edit', [ArchiveCardController::class, 'edit'])->name('archives.cards.edit');
//Route::middleware(['auth:sanctum', 'verified'])->put('archives/{archive:slug}/cards/{card:oracle_id}', [ArchiveCardController::class, 'update'])->name('archives.cards.update');
Route::middleware(['auth:sanctum', 'verified'])
    ->delete('archives/{archive:slug}/cards/{card:scryfall_id}', [ArchiveCardController::class, 'delete'])
    ->missing(function(){ return redirect()->route('archives.cards.index'); })
    ->name('archives.cards.delete');


Route::middleware(['auth:sanctum', 'verified'])->get('cards', [CardController::class, 'index'])->name('cards.index');
Route::middleware(['auth:sanctum', 'verified'])->get('cards/{card:oracle_id}', [CardController::class, 'show'])->name('cards.show')->whereUuid('card:oracle_id');

