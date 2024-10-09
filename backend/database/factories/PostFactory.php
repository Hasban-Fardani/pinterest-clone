<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $size = $this->faker->randomElement([[236, 555], [250, 250]]);
        return [
            'title' => $this->faker->sentence(),
            'image' => $this->faker->image('storage/app/public/posts', $size[0], $size[1], null, false),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
