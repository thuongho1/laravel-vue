<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tags')->truncate();
        Schema::enableForeignKeyConstraints();
        Tag::factory(5)->forCategory()->create();
    }
}
