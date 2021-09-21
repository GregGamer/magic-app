<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scryfall extends Model
{
    static $API_URL = 'https://api.scryfall.com';
    public $uuid;

    function __construct($uuid)
    {
        $this->uuid = $uuid;
    }
}
