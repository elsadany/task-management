<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ListTasksRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskDependency;
use App\services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function __construct(readonly TaskService $taskService) {}

    function index(ListTasksRequest $request)
    {
        $tasks = $this->taskService->all($request->validated());
        return $this->successResponse(data: $tasks);
    }

    function show($id)
    {
        $task = $this->taskService->find($id);
        return $this->successResponse(data: $task);
    }

    function store(TaskRequest $request)
    {
        $task = $this->taskService->create($request->getData());
        return $this->successResponse(data: $task);
    }

    function update(Task $task, TaskRequest $request)
    {
        $task = $this->taskService->update($task->id, $request->getData());
        return $this->successResponse(data: $task);
    }

    function addDependency(Task $task, Request $request)
    {
        $dependency = $this->taskService->addDependency($task->id, $request->all());
        if(!$dependency){
            return $this->errorResponse('circular dependency');
        }
        return $this->successResponse(data: $dependency);
    }

    function deleteDependency(TaskDependency $dependency)
    {
        $this->taskService->deleteDependency($dependency);
        return $this->successResponse('dependency deleted');
    }
}
 
