<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\EditionController;
use App\Models\FetchScryfallApi;

class Edition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function store_Editions_By_Editions($editions){
        foreach($editions as $edition){
            self::store_Edition_by_EditionObject($edition);
        }
    }

    public static function store_Edition_by_EditionObject($edition){
        if (! self::where('code', $edition->code)->exists()){
            // TODO: unbedingt eine andere Methode fürs speichern verwenden
            self::create([
                'scryfall_id' => $edition->id,
                'code' => $edition->code,
                'name' => $edition->name,
                'set_type' => $edition->set_type,
                'released_at' => isset($edition->released_at) ? $edition->released_at : '',
                'block_code' => isset($edition->block_code) ? $edition->block_code : '',
                'block' => isset($edition->block) ? $edition->block : '',
                'parent_set_code' => isset($edition->parent_set_code) ? $edition->parent_set_code : '',
                'card_count' => $edition->card_count,
                'digital' => $edition->digital,
                'foil_only' => $edition->foil_only,
                'nonfoil_only' => $edition->nonfoil_only,
                'scryfall_uri' => $edition->scryfall_uri,
                'uri' => $edition->uri,
                'icon_svg_uri' => $edition->icon_svg_uri,
                'search_uri' => $edition->search_uri,
            ]);
       }
    }

    public static function check_ApiEditions_with_DbEditions(){
        return self::all()->count() == FetchScryfallApi::fetch_Editions()->count();
    }

    public static function update_Editions(){
        $fetched_data = FetchScryfallApi::fetch_Editions();
        if($fetched_data->count() != self::all()->count()){
            self::delete_Editions();
            self::store_Editions_By_Editions($fetched_data);
        }
        return true;
    }

    public static function delete_Editions(){
        foreach(self::all() as $edition) {
            $edition->delete();
        }
    }

    public static function get_EditionSvg_By_Set($set_code){
        return self::where('set', $set_code)->first()->icon_svg_uri;
    }

    public static function updateTable(){
        self::update_Editions();
    }
}
