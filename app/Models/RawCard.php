<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use App\Models\Edition;
use App\Models\Card;
use App\Http\Controllers\RawCardController;

class RawCard extends Model
{
    use HasFactory;

    protected $guarded = array();

    public function cards(){
        return $this->hasMany(Card::class, 'rawcard_id', 'id');
    }

    public function edition()
    {
        return Edition::where('code', $this->set)->first();
    }

    public function rulings() {
        return collect(FetchScryfallApi::fetch_Rulings_By_Uri($this->rulings_uri)->data);
    }

    public function mana_symbols() {
        return Symbology::get_Symbology_By_SymbolString($this->mana_cost);
    }

    public function printings(){
        return self::where('oracle_id', $this->oracle_id)->get()->sortByDesc('released_at');
    }

    public function types() {
        // a function which seperates the type into supertype, type and subtype
        //return collect('supertype' => 'Legendary', 'type' => 'Creature');
    }

    public static function update_CardPrintings_By_fetchedPrinting($fetched_printing){
        $printings = FetchScryfallApi::fetch_CardPrintings_By_OracleId($fetched_printing->oracle_id, $fetched_printing->lang);

        foreach($printings as $printing) {
            if(! RawCard::where('scryfall_id', $printing->id)->exists()){
                RawCardController::store_RawCard_By_RawCardObject($printing);
            }
        }
    }

    public static function findScryfallId($scryfall_id){
        $fetched_printing = FetchScryfallApi::fetch_CardPrinting_By_ScryfallId($scryfall_id);
        self::update_CardPrintings_By_fetchedPrinting($fetched_printing);
        return self::where('scryfall_id', $scryfall_id)->first();
    }

    public function render_text() {
        $text = $this->printed_text ? $this->printed_text : $this->oracle_text;
        $name = $this->printed_name ? $this->printed_name : $this->name;

        $text = '<p class="py-1">' . $text . '</p>';
        $text = preg_replace(['/\\n/', '/'.$name.'/'], ['</p><p class="py-1">', '<span class="font-bold">'.$name.'</span>'], $text);
        foreach(Symbology::all() as $symbol){
            $text = str_replace( $symbol->symbol, '<img class="h-5 inline-block mx-1" src="'. $symbol->svg_uri .'" alt="'. $symbol->english .'">', $text);
        }

        return $text;
    }

    /////////////////////////////////////////

    public static function fetchRandomCard(){
        $randomCard = Http::get('https://api.scryfall.com/cards/random')->object();
        return $randomCard;
    }

    public static function fetchCardByUUID(string $card_uuid){
        $CardById = Http::get('https://api.scryfall.com/cards/' . $card_uuid)->object();
        return $CardById;
    }
}
