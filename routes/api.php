<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserTaskController;
use App\Http\Middleware\ManagerMiddleWare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('user-tasks', UserTaskController::class)->only(['index', 'show', 'update']);

    Route::middleware(ManagerMiddleWare::class)->group(function () {
        Route::apiResource('tasks', TaskController::class);
        Route::post('tasks/{task}/dependencies', [TaskController::class, 'addDependency']);
        Route::delete('dependencies/{dependency}', [TaskController::class, 'deleteDependency']);
        Route::get('users', [UserController::class, 'index']);
    });
});
