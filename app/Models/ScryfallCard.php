<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use App\Models\Scryfall;

class ScryfallCard extends Scryfall
{
    public function raw()
    {
        return Http::get(self::$API_URL . '/cards/' . $this->uuid)->object();
    }

    public function edition()
    {
        return 'edition';
    }
}
