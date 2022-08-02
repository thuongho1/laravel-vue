<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $author = User::all()->random();
        $post = Post::all()->random();
        return [
            'title' => 'Comment on ' . $post->getAttribute('title') . ' by user ' . $author->getAttribute('name'),
            'content' => '<p>' . $this->faker->paragraph() . '</p>',
            'author_id' => $author->id,
            'post_id' => $post->id,
        ];
    }
}
