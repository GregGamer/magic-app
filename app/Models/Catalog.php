<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = ['key','value'];

    public static function keyword_abilities() {
        return self::where('key','keyword-abilities')->get()->pluck('value');
    }

    public static function keyword_actions() {
        return self::where('key','keyword-actions')->get()->pluck('value');
    }

    public static function ability_words() {
        return self::where('key','ability-words')->get()->pluck('value');
    }

    public static function updateTable(){
        $catalogs = [
            //'card-names',
            'artist-names',
            //'word-bank',
            'creature-types',
            'planeswalker-types',
            'land-types',
            'artifact-types',
            'enchantment-types',
            'spell-types',
            'powers',
            'toughnesses',
            'loyalties',
            //'watermarks',
            'keyword-abilities',
            'keyword-actions',
            'ability-words'
        ];

        foreach ($catalogs as $catalog) {
            $catalog_values = self::check_Catalog_By_Name($catalog);

            if ($catalog_values !== true){
                self::delete_Catalog_By_Name($catalog);

                foreach ($catalog_values as $catalog_value) {
                    self::create([
                        'key' => $catalog,
                        'value' => $catalog_value
                    ]);
                }
            }
        }
    }

    // check function returns an collection with all values from api:
    // -> if it does not match with the values in the database
    // -> if it does match it returns only a boolean true
    public static function check_Catalog_By_Name(string $catalog)
    {
        $fetched_Data = FetchScryfallApi::fetch_Catalog_By_Name($catalog);

        if (Catalog::where('key', $catalog)->get()->count() == $fetched_Data->count())
            return true;

        return $fetched_Data;
    }

    public static function delete_Catalog_By_Name($catalog){
        $catalog_values = self::where('key', $catalog)->get();

        foreach ($catalog_values as $catalog_value) {
            $catalog_value->delete();
        }
    }
}
