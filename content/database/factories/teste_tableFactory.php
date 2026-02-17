<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\teste_table;
use App\Models\article;

class teste_tableFactory extends Factory
{

    protected $model = article::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description_art' => $this->faker->text(20),
            'qt_art' => $this->faker->numberBetween(1, 100),
            'seuil_art' => $this->faker->numberBetween(1, 100),
            'id_categ' => $this->faker->numberBetween(1, 10),
        ];
    }
}
