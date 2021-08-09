<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class FetchScryfallApi extends Model
{
    use HasFactory;

    public static function fetch_RandomCard(){
        return Http::get("https://api.scryfall.com/cards/random")->object();
    }
}
