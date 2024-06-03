<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassType::factory()->create([
            'name' => 'Yoga',
            'description' => fake()->text(),
            'minutes' => 60,
        ]);
        ClassType::factory()->create([
            'name' => 'Dance Fitness',
            'description' => fake()->text(),
            'minutes' => 45,
        ]);
        ClassType::factory()->create([
            'name' => 'Pilates',
            'description' => fake()->text(),
            'minutes' => 60,
        ]);
        ClassType::factory()->create([
            'name' => 'Boxing',
            'description' => fake()->text(),
            'minutes' => 50,
        ]);
    }
}
