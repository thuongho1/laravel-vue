<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        Schema::enableForeignKeyConstraints();
        $roles = Role::factory()->count(4)->create();
        User::factory()
            ->hasAttached($roles)
            ->create(
                [
                    'name' => 'Admin',
                    'email' => 'admin@jsonapi.com',
                    'password' => 'secret'
                ]
            );
    }
}
