<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        for ($count = 0; $count < 10; $count++) {
            $project = \App\Project::create([
                'title' => $faker->name
            ]);

            for ($count2 = 0; $count2 < 10; $count2++) {
                \App\Task::create([
                    'title' => $faker->name,
                    'project_id' => $project->id,
                    'status' => \App\Helpers\TaskStatus::InProgress
                ]);
            }
        }
    }
}
