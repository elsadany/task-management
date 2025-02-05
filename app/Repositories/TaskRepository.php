<?php
namespace App\Repositories;

use App\Models\Task;
use App\Models\TaskDependency;
use App\Models\User;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(array $filters = [])
    {
        return Task::query()->with('dependencies')->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);
        })->when($filters['date_from'] ?? null, function ($query, $date_from) {
            $query->where('due_date', '>=', $date_from);
        })->when($filters['date_to'] ?? null, function ($query, $date_to) {
            $query->where('due_date', '<=', $date_to);
        })->when($filters['assignee_id'] ?? null, function ($query, $assignee_id) {
            $query->where('assignee_id', $assignee_id);
        })->latest()->paginate(20);
    }
    public function getByUser(User $user)
    {
        return Task::query()->with('dependencies')->where('assignee_id', $user->id)
            ->when($filters['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })->when($filters['date_from'] ?? null, function ($query, $date_from) {
                $query->where('due_date', '>=', $$date_from);
            })->when($filters['date_to'] ?? null, function ($query, $date_to) {
                $query->where('due_date', '<=', $date_to);
            })->latest()->paginate(20);
    }
    public function find($id, array $filters = [])
    {
        
        return Task::query()->with('dependencies')->where('id', $id)
        ->when($filters['assignee_id'] ?? null, function ($query, $assignee_id) {
            $query->where('assignee_id', $assignee_id);
        })->firstOrFail();
    }
    public function create($data)
    { 
        $task = Task::create($data->except('dependencies')->toArray());
        return $task;
    }
    public function update(Task $task, $data)
    {
        $task->update($data->except('dependencies')->toArray());
    
        return $task;
    }
    public function updateStatus(Task $task, $data)
    {
        $task->update($data);
        return $task;
    }
    public function addDependency(Task $task, array $data)
    {
        TaskDependency::firstOrCreate([
            'task_id' => $task->id,
            'dependency_id' => $data['dependency_id']
        ]);
        return $task;
    }
    
    public function deleteDependency(TaskDependency $dependency)
    {
        return $dependency->delete();
    }
   
    
   
}
