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
    // TODO: Rewrite the printings count logic, since it does not check if it exists

    public static function fetch_RandomCard(){
        return Http::get("https://api.scryfall.com/cards/random")->object();
    }

    public static function fetch_CardPrintings_By_OracleId($oracle_id){
        return Http::get('https://api.scryfall.com/cards/search', [
            'order' => 'released',
            'q' => 'oracleid:'.$oracle_id,
            'unique' => 'prints'
        ])->object()->data;
    }

    public static function store_CardPrintings_By_OracleId($oracle_id){
        $printings = FetchScryfallApi::fetch_CardPrintings_By_OracleId($oracle_id);
        if (RawCard::where('oracle_id', $oracle_id)->get()->count() === count($printings)){
            foreach($printings as $printing){
                if(! RawCard::where('scryfall_id', $printing->id)->exists()){
                    RawCardController::store_RawCard_By_RawCardObject($printing);
                }
            }
        }
    }

    public static function store_CardPrintings_By_CardPrintings($card_printings){
        foreach($card_printings as $card_printing){
            if(! RawCard::where('scryfall_id', $card_printing->id)->exists()){
                RawCardController::store_RawCard_By_RawCardObject($card_printing);
            }
        }
    }

    public static function update_CardPrintings_By_OracleId($oracle_id){
        $printings = FetchScryfallApi::fetch_CardPrintings_By_OracleId($oracle_id);

        if($printings->count() === RawCard::where('oracle_id', $oracle_id)->get()->count()){
            FetchScryfallApi::store_CardPrintings_By_CardPrintings($printings);            
        }
    }

    public static function get_CardPrintings_By_OracleId($oracle_id){
        return RawCard::where('oracle_id', $oracle_id)->get();
    }

    //////////////////////////////////////////////////////
    // Edition
    //////////////////////////////////////////////////////

    public static function fetch_Editions(){
        return collect(Http::get('https://api.scryfall.com/sets')->object()->data);
    }

    public static function fetch_Edition_By_Set($set_code){
        return collect(Http::get('http://api.scryfall.com/sets/'.$set_code)->object());
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
