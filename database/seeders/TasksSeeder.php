<?php

namespace Database\Seeders;

use App\Models\Task;
use App\services\TaskService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request as HttpRequest;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(30)->create();

        foreach (Task::all() as $task) {

            app(TaskService::class)->addDependency($task->id, [
                'dependency_id' => Task::inRandomOrder()->where('id', '!=', $task->id)->first()->id,
            ]);
        }
    }
}
