<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\ClassType;
// use user seeder
use Database\Seeders\UserSeeder;
use Database\Seeders\ClassTypeSeeder;
use Database\Seeders\ScheduledClassSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClassTypeSeeder::class,
            ScheduledClassSeeder::class,
        ]); 

        // Article::factory()->times(50)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
