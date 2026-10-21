<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        Project::truncate();
        for ($i = 1; $i <= 10; $i++) {
            Project::create([
                'title' => 'Project Judul Ke-' . $i,
                'description' => 'Deskripsi untuk project judul ke-' . $i,
            ]);
        }
    }
}