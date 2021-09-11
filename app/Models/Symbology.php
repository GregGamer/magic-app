<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbology extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'loose_variant',
        'english',
        'transposable',
        'represents_mana',
        'cmc',
        'appears_in_mana_costs',
        'funny',
        'colors',
        'gatherer_alternates',
        'svg_uri',
    ];

    public static function get_Symbology_By_Symbol($symbol)
    {
        return self::where('symbol', $symbol)->first();
    }

    public static function get_Symbology_By_SymbolString($symbol_string)
    {
        $pattern = '/{\w+}/';
        preg_match_all($pattern, $symbol_string, $symbol, PREG_OFFSET_CAPTURE);
        $symbol = collect($symbol[0])->pluck(0);
        return $symbol->map(function ($item, $key) {
            return self::get_Symbology_By_Symbol($item);
        });
    }

    public static function updateTable() {
        $symbols = self::check_Symbology();

        if ($symbols !== true) {
            self::delete_all_symbols();
            self::create_Symbology_By_symbols($symbols);
        }
    }

    public static function check_Symbology(){
        $fetched_Data = FetchScryfallApi::fetch_Symbology();

        if ($fetched_Data->count() != self::all()->count()) {
            return $fetched_Data;
        }
        return true;
    }

    public static function delete_all_symbols(){
        foreach(self::all() as $symbol){
            $symbol->delete();
        }
    }

    public static function create_Symbology_By_symbols($symbols){
        foreach($symbols as $symbol){
            self::create_Symbology_By_symbol($symbol);
        }
    }

    public static function create_Symbology_By_symbol($symbol){
        self::create([
            'symbol' => $symbol->symbol,
            'loose_variant' => $symbol->loose_variant ? $symbol->loose_variant : '',
            'english' => $symbol->english,
            'transposable' => $symbol->transposable,
            'represents_mana' => $symbol->represents_mana,
            'cmc' => $symbol->cmc ? $symbol->cmc : 0,
            'appears_in_mana_costs' => $symbol->appears_in_mana_costs,
            'funny' => $symbol->funny,
            'colors' => json_encode($symbol->colors),
            'gatherer_alternates' => json_encode($symbol->gatherer_alternates),
            'svg_uri' => $symbol->svg_uri,

        ]);
    }
}
