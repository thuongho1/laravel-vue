<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = 'Test tag ' . $this->faker->unique()->text(10);
        return [
            'title' => $title,
            'description' => '<p>' . $this->faker->paragraph() . '</p>',
            'user_id' => 1,
            'category_id' => Category::factory(),
            'status' => 1,
            'slug' => Str::slug($title),
        ];
    }
}
