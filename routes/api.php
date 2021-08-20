<?php

use App\Http\Controllers\ArchiveCardController;
use App\Models\FetchScryfallApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('cards/random', fn() => FetchScryfallApi::fetch_RandomCard());

Route::get('cards/search', [ArchiveCardController::class, 'search'])->name('cards.search');

Route::get('cards/fetch', [FetchScryfallApi::class, 'fetch_Cards_By_Request'])->name('cards.fetch.formatted');

