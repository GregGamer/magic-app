<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use App\Models\Scryfall;

class ScryfallCard extends Scryfall
{
    public $raw;

    public function __construct($uuid)
    {
       $this->uuid = $uuid;
       $this->raw = $this->raw();
    }

    public function raw()
    {
        echo 'http request got sent';
        return Http::get(self::$API_URL . '/cards/' . $this->uuid)->object();
    }

    public function edition()
    {
        return collect(['code' => $this->raw->set, 'name' => $this->raw->set_name]);
    }

    public function artist()
    {
        return 'WIP: not working yet';
    }

    public function faces()
    {
        return 'WIP: not working yet';
    }

    public function face()
    {
        return 'WIP: not working yet';
    }

    public function mana()
    {
        return 'WIP: not working yet';
    }

    public function meta()
    {
        return 'WIP: not working yet';
    }

    public function printings()
    {
        return 'WIP: not working yet';
    }

    public function printing()
    {
        return 'WIP: not working yet';
    }

    public function rulings()
    {
        return 'WIP: not working yet';
    }

    public function ruling()
    {
        return 'WIP: not working yet';
    }


}
