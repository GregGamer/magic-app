<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Scryfall extends Model
{
    use HasFactory;
    static $API_URL = 'https://api.scryfall.com';
    public $uuid;

    function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    public static function findCard($uuid)
    {
        return Http::get(self::$API_URL . '/cards/' . $uuid)->object();
    }

    public static function findEdition($uuid)
    {
        return Http::get(self::$API_URL . '/sets/' . $uuid)->object();
    }
}
