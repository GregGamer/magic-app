<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FetchScryfallApi extends Model
{
    use HasFactory;

    // TODO: Sort out the Code put it away from this class
            // in other words change the location of the methods, here should only go fetch methods!

    // TODO: Rewrite the printings count logic, since it does not check if it exists

    public static function fetch_RandomCard(){
        return Http::get("https://api.scryfall.com/cards/random")->object();
    }

    public static function fetch_Rulings_By_Uri($rulings_uri){
        return Http::get($rulings_uri)->object();
    }

    public static function fetch_CardPrinting_By_ScryfallId($scryfall_id){
        return Http::get('https://api.scryfall.com/cards/' . $scryfall_id)->object();
    }

    public function fetch_Cards_By_Request(Request $request)
    {
        return FetchScryfallApi::fetch_Cards_By_Name($request->term)
            ->unique('name');
    }

    public static function fetch_Cards_By_Name($name)
    {
        return collect(Http::get('https://api.scryfall.com/cards/search', [
            'order' => 'released',
            'q' => 'name:' . $name . ' lang:de',
            'unique' => 'prints'
        ])->object()->data);
    }

    public static function fetch_Card_By_Query($query)
    {
        return collect(Http::get('https://api.scryfall.com/cards/search', [
            'order' => 'released',
            'q' => $query,
            'unique' => 'prints'
        ])->object()->data);
    }

    public static function fetch_CardPrintings_By_OracleId($oracle_id, $lang='en'){
        return collect(Http::get('https://api.scryfall.com/cards/search', [
            'order' => 'released',
            'q' => 'oracleid:' . $oracle_id . ' lang:' . $lang,
            'unique' => 'prints'
        ])->object()->data);
    }

   //////////////////////////////////////////////////////
    // Edition
    //////////////////////////////////////////////////////

    public static function fetch_Editions(){
        return collect(Http::get('https://api.scryfall.com/sets')->object()->data);
    }

    public static function fetch_Edition_By_Set($set_code){
        return Http::get('http://api.scryfall.com/sets/'.$set_code)->object();
    }

    //////////////////////////////////////////////////////
    // Symbology
    //////////////////////////////////////////////////////

    public static function fetch_Symbology(){
        return collect(Http::get('https://api.scryfall.com/symbology')->object()->data);
    }

    //////////////////////////////////////////////////////
    // Catalogs
    //////////////////////////////////////////////////////

    public static function fetch_Catalog_By_Name($catalog){
        return collect(Http::get('https://api.scryfall.com/catalog/' . $catalog)->object()->data);
    }
}
