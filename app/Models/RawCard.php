<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RawCard extends Model
{
    use HasFactory;

    protected $guarded = array();

    public function edition(){
        return $this->hasOne(Edition::class);
    }

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
