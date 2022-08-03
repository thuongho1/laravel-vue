<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('taggables')->truncate();
        DB::table('categories')->truncate();
        DB::table('ratings')->truncate();
        DB::table('comments')->truncate();
        Schema::enableForeignKeyConstraints();
        $category = Category::factory()->create();

        $tags = Tag::factory(2)
            ->for($category)
            ->create();

        Post::factory()
            ->count(3)
            ->has(Rating::factory()->count(2))
            ->has(Comment::factory()->count(2))
            ->hasAttached($tags)
            ->create();
    }
}
