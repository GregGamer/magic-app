<?php

namespace Database\Factories;

use App\Models\Archive;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArchiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Archive::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'collection_id' => 1,
            'isFolder' => $this->faker->boolean(),
            'maxCardsInSlot' => 4

        ];
    }
}
