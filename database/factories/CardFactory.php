<?php

namespace Database\Factories;

use App\Models\Archive;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_uuid' => Card::getRandomUUID,
            'archive_id' => Archive::all()->random(1)->first(),
            'deck_id' => null,
        ];
    }

    public static function getRandomUUID(){

        $randomCard = Http::get('https://api.scryfall.com/cards/random')->object();

        return $randomCard->id;
    }
}
