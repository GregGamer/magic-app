<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Self_;
use App\Http\Controllers\RawCardController;

class FetchScryfallApi extends Model
{
    use HasFactory;

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

    public static function get_EditionSvg_By_Set(){

    }
}
