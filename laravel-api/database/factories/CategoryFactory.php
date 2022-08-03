<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = 'Test category ' . $this->faker->text(10);

        return [
            'title' => $title,
            'description' => '<p>' . $this->faker->paragraph() . '</p>',
            'status' => 1,
            'slug' => Str::slug($title),
            'user_id' => 1,
        ];
    }
}
