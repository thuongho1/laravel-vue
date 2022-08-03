<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'title' => $this->faker->text(10),
            'rate' => $this->faker->numberBetween(1, 5),
            'comment' => '<p>' . $this->faker->paragraph() . '</p>',
            'user_id' => 1,
            'post_id' => Post::factory(),
        ];
    }
}
