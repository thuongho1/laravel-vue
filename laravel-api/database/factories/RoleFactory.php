<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $role_data = [
            'Admin',
            'Reviewer',
            'Editor',
            'Author'
        ];
        $role = $this->faker->unique(false, 4)->randomElement($role_data);
        return [
            'title' => $role,
            'slug' => Str::slug($role),
        ];
    }
}
