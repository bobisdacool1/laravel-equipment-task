<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->lexify('????-????-????'),
            'type_id' => $this->faker->numberBetween(1, 3),
            'note' => $this->faker->text,
        ];
    }
}
