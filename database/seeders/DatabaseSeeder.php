<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $project1 = Project::factory()->create();
        Task::factory()->for($project1)->create();
        Task::factory()->for($project1)->create();
        Task::factory()->for($project1)->create();

        $project2 = Project::factory()->create();
        Task::factory()->for($project2)->create();
        Task::factory()->for($project2)->create();
        Task::factory()->for($project2)->create();

        $project3 = Project::factory()->create();
        Task::factory()->for($project3)->create();
        Task::factory()->for($project3)->create();
        Task::factory()->for($project3)->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
