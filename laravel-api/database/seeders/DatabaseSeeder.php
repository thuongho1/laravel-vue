<?php
namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('comments')->truncate();
        Schema::enableForeignKeyConstraints();

        $this->call(UsersSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(CommentSeeder::class);

    }
}
