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
Route::middleware(['auth:sanctum', 'verified'])->name('archives.')->group(function() {
    Route::get('archives', [ArchiveController::class, 'index'])
        ->name('index');

    Route::get('archives/create', [ArchiveController::class, 'create'])
        ->name('create');
        
    Route::post('archives', [ArchiveController::class, 'store'])
        ->name('store');
        
    Route::get('archives/{archive:slug}', [ArchiveController::class, 'show'])
        ->missing(function(){ return redirect()->route('archives.index'); })
        ->name('show');
        
    Route::get('archives/{archive:slug}/edit', [ArchiveController::class, 'edit'])
        ->name('edit');
        
    Route::put('archives/{archive:slug}', [ArchiveController::class, 'update'])
        ->name('update');

    Route::delete('archives/{archive:slug}', [ArchiveController::class, 'delete'])
        ->name('delete');
});


/******************************************************* 
 *        Deck Routes
********************************************************/
//Route::middleware(['auth:sanctum', 'verified'])->resource('decks', DeckController::class);
Route::middleware(['auth:sanctum', 'verified'])->name('decks.')->group(function() {
    Route::get('decks', [DeckController::class, 'index'])
        ->name('index');

    Route::get('decks/create', [DeckController::class, 'create'])
        ->name('create');

    Route::post('decks', [DeckController::class, 'store'])
        ->name('store');

    Route::get('decks/{deck:slug}', [DeckController::class, 'show'])
        ->name('show');

    Route::get('decks/{deck:slug}/edit', [DeckController::class, 'edit'])
        ->name('edit');

    Route::put('decks/{deck:slug}', [DeckController::class, 'update'])
        ->name('update');
        
    Route::delete('decks/{deck:slug}', [DeckController::class, 'delete'])
        ->name('delete');
});


/******************************************************* 
 *        Archive Card Routes
********************************************************/
//Route::middleware(['auth:sanctum', 'verified'])->resource('archives.cards', ArchiveCardController::class);
Route::middleware(['auth:sanctum', 'verified'])->name('archives.cards.')->group(function(){
    Route::get('archives/{archive:slug}/cards', [ArchiveController::class, 'show'])
        ->missing(function(){ return redirect()->route('archives.index'); })
        ->name('index');
        
    Route::put('archives/{archive:slug}/cards/{card:scryfall_id}', [ArchiveCardController::class, 'store'])
        ->missing(function(){ return redirect()->route('archives.cards.index'); })
        ->name('store');
        
    Route::get('archives/{archive:slug}/cards/{card:oracle_id}', [ArchiveCardController::class, 'show'])
        ->missing(function(){ return redirect()->route('archives.cards.index'); })
        ->name('show');
        
    Route::delete('archives/{archive:slug}/cards/{card:scryfall_id}', [ArchiveCardController::class, 'delete'])
        ->missing(function(){ return redirect()->route('archives.cards.index'); })
        ->name('delete');
});


Route::middleware(['auth:sanctum', 'verified'])->get('cards', [CardController::class, 'index'])->name('cards.index');
Route::middleware(['auth:sanctum', 'verified'])->get('cards/{card:oracle_id}', [CardController::class, 'show'])->name('cards.show')->whereUuid('card:oracle_id');

