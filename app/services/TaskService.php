<?php

namespace App\services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskDependency;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    function all(array $filters = [])
    {
        return TaskResource::collection($this->taskRepository->all($filters))->response()->getData(true);
    }

    function create($data)
    {
        return $this->taskRepository->create($data);
    }

    function update($id, $data)
    {
        $task = $this->taskRepository->find($id);
        return $this->taskRepository->update($task, $data);
    }

    function  delete($id)
    {
        return $this->taskRepository->delete($id);
    }

    function updateStatus($id, $data)
    {
        $task = $this->taskRepository->find($id);
        if($task->dependencies()->pending()->count()){
            return null;
        }
        return $this->taskRepository->updateStatus($task, $data->toArray());
    }

    function getByUser($user, array $filters = [])
    {
        return $this->taskRepository->getByUser($user, $filters);
    }

    function find($id, array $filters = [])
    {
        return $this->taskRepository->find($id, $filters);
    }

    function addDependency($id, $data)
    {
        $task = $this->taskRepository->find($id);

        if ($this->hasCircularDependency($task->id, $data['dependency_id'])) {
            return null;
        }
        return $this->taskRepository->addDependency($task, $data);
    }
    protected function hasCircularDependency($taskId, $dependencyId, $visited = [])
    {
        // If the task is already in the visited list, it's a circular dependency
        if (in_array($taskId, $visited)) {
            return true;
        }


        // Add the current task to the visited list
        $visited[] = $taskId;

        // Get all dependencies of the current task
        $dependencies = TaskDependency::where('task_id', $dependencyId)->get();

        // Recursively check each dependency
        foreach ($dependencies as $dependency) {
            if ($this->hasCircularDependency($taskId, $dependency->dependency_id, $visited)) {
                return true;
            }
        }

        return false;
    }
    function deleteDependency($id)
    {
        return $this->taskRepository->deleteDependency($id);
    }
}
