<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use App\Models\Scryfall;

class ScryfallEdition extends Scryfall
{
    public function raw()
    {
        return Http::get(self::$API_URL . '/sets/' . $this->uuid)->object();
    }
}
