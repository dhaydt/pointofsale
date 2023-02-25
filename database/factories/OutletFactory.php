<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OutletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_outlet' => $this->faker->name(),
            // 'office_id' => $this->faker->id(),
            'address' => $this->faker->address(),
        ];
    }
}
