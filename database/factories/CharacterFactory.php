<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'height' => $this->faker->numberBetween(150, 200),
            'mass' => $this->faker->numberBetween(45, 120),
            'hair_color' => $this->faker->colorName(),
            'skin_color' => $this->faker->colorName(),
            'homeworld' => $this->faker->word()
        ];
    }
}
