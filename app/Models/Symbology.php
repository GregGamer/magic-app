<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbology extends Model
{
    use HasFactory;

    public static function get_Symbology_By_Symbol($symbol)
    {
        return Symbology::where('symbol', $symbol)->first();
    }

    public static function get_Symbology_By_SymbolString($symbol_string)
    {
        $pattern = '/{\w+}/';
        preg_match_all($pattern, $symbol_string, $symbol, PREG_OFFSET_CAPTURE);
        $symbol = collect($symbol[0])->pluck(0);
        return $symbol->map(function ($item, $key) {
            return Symbology::get_Symbology_By_Symbol($item);
        });
    }
}
