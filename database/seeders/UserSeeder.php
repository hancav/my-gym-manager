<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 1 user admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

         // create 1 user instructor
         User::factory()->create([
            'name' => 'john',
            'email' => 'john@example.com',
            'role' => 'instructor',
        ]);

        // create first user member
        User::factory()->create([
            'name' => 'hugo',
            'email' => 'hugo@example.com',
        ]);

         // create second user member
         User::factory()->create([
            'name' => 'taylor',
            'email' => 'taylor@example.com',
        ]);

        // create 10 users members
        User::factory()->count(10)->create();

        // create 10 users instructors
        User::factory()->count(10)->create([
            'role' => 'instructor',
        ]);
    }
}
