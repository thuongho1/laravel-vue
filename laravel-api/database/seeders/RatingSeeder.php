<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Schema::disableForeignKeyConstraints();
            DB::table('ratings')->truncate();
            Schema::enableForeignKeyConstraints();
            Rating::factory(20)->create();
        }
    }
}
