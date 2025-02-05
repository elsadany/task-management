<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ListTasksRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\services\TaskService;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    function __construct(readonly TaskService $taskService) {}

    function index(ListTasksRequest $request)
    {
        $tasks = $this->taskService->all(array_merge($request->validated(), ['assignee_id' => $request->user()->id]));
        return $this->successResponse(data: $tasks);
    }

    function show($id, Request $request)
    {
        $task = $this->taskService->find($id, ['assignee_id' => $request->user()->id]);
        return $this->successResponse(data: $task);
    }

    function update($id, UpdateTaskStatusRequest $request)
    {
        $task = $this->taskService->updateStatus($id, $request->getData());
        if(!$task){
            return $this->errorResponse('Can`t delete has non completed dependencies');
        }
        return $this->successResponse(data: $task);
    }
}
