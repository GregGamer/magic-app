<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use App\Models\Edition;
use App\Http\Controllers\RawCardController;

class RawCard extends Model
{
    use HasFactory;

    protected $guarded = array();

    public function cards(){
        return $this->hasMany(Card::class);
    }

    public function edition()
    {
        return Edition::where('code', $this->set)->first();
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

    public static function store_CardPrinting_By_ScryfallId($scryfall_id){
        $printing = FetchScryfallApi::fetch_CardPrinting_By_ScryfallId($scryfall_id);
        ddd($printing);

        if(! RawCard::where('scryfall_id', $printing->id)->exists()){
            RawCardController::store_RawCard_By_RawCardObject($printing);
        }

        return RawCard::where('scryfall_id', $printing->id)->first();
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

        if(! RawCard::where('oracle_id', $printings->first()->oracle_id)->exists()){
            RawCardController::store_RawCard_By_RawCardObject($printings->first());
        }

        if(! RawCard::check_CardPrintings_with_CardPrintingsApi_By_OracleId($oracle_id)){
            RawCard::store_CardPrintings_By_CardPrintings($printings);            
        }
    }

    public static function check_CardPrintings_with_CardPrintingsApi_By_OracleId($oracle_id){
        return FetchScryfallApi::fetch_CardPrintings_By_OracleId($oracle_id) === RawCard::where('oracle_id', $oracle_id)->get()->count();
    }

    public static function get_CardPrintings_By_OracleId($oracle_id){
        return RawCard::where('oracle_id', $oracle_id)->get();
    }

    /////////////////////////////////////////

    public static function rawCardFields(){
        $tmp_object = new RawCard();
        $table = $tmp_object;
        return \Schema::getColumnListing($table);
    }

    public static function fetchRandomCard(){
        $randomCard = Http::get('https://api.scryfall.com/cards/random')->object();
        return $randomCard; 
    }

    public static function fetchCardByUUID(string $card_uuid){
        $CardById = Http::get('https://api.scryfall.com/cards/' . $card_uuid)->object();
        return $CardById; 
    }

    public static function getCardPrintings(string $card_uuid){
        $rawcard = RawCard::fetchCardByUUID($card_uuid);
        $printings_url = $rawcard->prints_search_uri;
        $printings = Http::get($printings_url)->object()->data;
        return $printings;
    }
}
