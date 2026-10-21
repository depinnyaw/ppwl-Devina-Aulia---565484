<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class RandomProjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            Project::create([
                'title' => fake()->unique()->sentence(3),
                'description' => fake()->paragraph(),
                'status' => 'published',
            ]);
        }
    }
}