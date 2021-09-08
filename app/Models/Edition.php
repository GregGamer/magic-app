<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\EditionController;
use App\Models\FetchScryfallApi;

class Edition extends Model
{
    use HasFactory;

    public static function store_Editions(){
        $editions = FetchScryfallApi::fetch_Editions();

        foreach($editions as $edition){
            Edition::store_Edition_by_EditionObject($edition);
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
        if(! Edition::check_ApiEditions_with_DbEditions()){
            Edition::store_Editions();
        }
        return true;
    }

    public static function get_EditionSvg_By_Set($set_code){
        return Edition::where('set', $set_code)->first()->icon_svg_uri;
    }



}
