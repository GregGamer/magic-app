<?php

namespace Database\Seeders;

use App\Http\Controllers\EditionController;
use App\Models\Archive;
use App\Models\Card;
use App\Models\Edition;
use App\Models\RawCard;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Team::factory(1)->create();
        Archive::factory(2)->create();
        for($i = 0; $i < 20; $i++){
            print_r($i+1);
            RawCard::factory(1)->create();
        }
        Card::factory(500)->create();
        EditionController::fetchSets();
    }
}
