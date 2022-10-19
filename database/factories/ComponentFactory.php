<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parent_id' => 1,
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'options' => [
                'size' => [
                    'width' => $this->faker->numberBetween(1, 1000),
                    'height' => $this->faker->numberBetween(1, 1000)
                ],
                'position' => [
                    'x' => $this->faker->numberBetween(1, 1000),
                    'y' => $this->faker->numberBetween(1, 1000)
                ],
            ]
        ];
    }
}
