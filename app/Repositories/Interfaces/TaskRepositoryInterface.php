<?php
namespace App\Repositories\Interfaces;

use App\Models\Task;
use App\Models\TaskDependency;
use App\Models\User;

interface TaskRepositoryInterface
{
    public function all(array $filters = []);
    public function getByUser(User $user);
    public function find($id, array $filters = []);
    public function create($data);
    public function update(Task $task, array $data);
    public function updateStatus(Task $task, array $data);
    public function addDependency(Task $task, array $data);
    public function deleteDependency(TaskDependency $dependency);
   
}