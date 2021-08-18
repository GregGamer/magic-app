<?php

namespace App\Models;

use App\Http\Controllers\EditionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Self_;
use App\Http\Controllers\RawCardController;

class FetchScryfallApi extends Model
{
    use HasFactory;

    // TODO: Sort out the Code put it away from this class
            // in other words change the location of the methods, here should only go fetch methods!

    // TODO: Rewrite the printings count logic, since it does not check if it exists

    public static function fetch_RandomCard(){
        return Http::get("https://api.scryfall.com/cards/random")->object();
    }

    public static function fetch_CardPrinting_By_ScryfallId($scryfall_id){
        return collect(Http::get('https://api.scryfall.com/cards/' . $scryfall_id)->object());
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

    public static function fetch_CardPrintings_By_OracleId($oracle_id){
        return collect(Http::get('https://api.scryfall.com/cards/search', [
            'order' => 'released',
            'q' => 'oracleid:' . $oracle_id,
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
        return collect(Http::get('http://api.scryfall.com/sets/'.$set_code)->object()->data);
    }

    public static function store_Editions(){
        $editions = FetchScryfallApi::fetch_Editions();

        foreach($editions as $edition){
            FetchScryfallApi::store_Edition_by_EditionObject($edition);
        }
    }

    public static function store_Edition_by_EditionObject($edition){
        if (! Edition::where('code', $edition->code)->exists()){
            // TODO: unbedingt eine andere Methode fürs speichern verwenden
            (new EditionController)->store($edition);
       }
    }

    public static function check_ApiEditions_with_DbEditions(){
        return Edition::all()->count() == FetchScryfallApi::fetch_Editions()->count();
    }

    public static function update_Editions(){
        $editions = FetchScryfallApi::fetch_Editions();
        if(! FetchScryfallApi::check_ApiEditions_with_DbEditions()){
            FetchScryfallApi::store_Editions();
        }
        return true;
    }

    public static function get_EditionSvg_By_Set($set_code){
        return Edition::where('set', $set_code)->first()->icon_svg_uri;
    }


}
