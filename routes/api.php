<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'task', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{userId}', [TaskController::class, 'index']);
    Route::post('add', [TaskController::class, 'store']);
    Route::get('edit/{taskId}', [TaskController::class, 'edit']);
    Route::post('update', [TaskController::class, 'update']);
    Route::delete('delete/{id}', [TaskController::class, 'destroy']);
});