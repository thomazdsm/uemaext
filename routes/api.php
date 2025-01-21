<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ProjectAssignmentsController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/login', [AuthController::class, 'login']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('activities', ActivityController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('project_assignments', ProjectAssignmentsController::class);
    Route::apiResource('reports', ReportController::class);
});
