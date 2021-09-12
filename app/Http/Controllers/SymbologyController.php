<?php

namespace App\Http\Controllers;

use App\Models\Symbology;
use Illuminate\Http\Request;

class SymbologyController extends Controller
{
    public static function store_By_Symbols($symbol)
    {
        if ($symbol->funny)
            return false;
        echo $symbol->funny;

        $new_symbol = new Symbology();

        $new_symbol->symbol = $symbol->symbol;
        $new_symbol->loose_variant = $symbol->loose_variant ? $symbol->loose_variant : "";
        $new_symbol->english = $symbol->english;
        $new_symbol->transposable = $symbol->transposable;
        $new_symbol->represents_mana = $symbol->represents_mana;
        $new_symbol->cmc = $symbol->cmc ? $symbol->cmc : 1;
        $new_symbol->appears_in_mana_costs = $symbol->appears_in_mana_costs;
        $new_symbol->funny = $symbol->funny;
        $new_symbol->colors = json_encode($symbol->colors);
        $new_symbol->gatherer_alternates = $symbol->gatherer_alternates ? json_encode($symbol->gatherer_alternates) : json_encode("");
        $new_symbol->svg_uri = $symbol->svg_uri ? $symbol->svg_uri : "";

        $new_symbol->save();

    }

}
