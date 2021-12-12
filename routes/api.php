<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController
};

/** Cursos */
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::post('/courses', [CourseController::class, 'store']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

/** Cursos - Módulos */
Route::get('/courses/{course}/modules', [ModuleController::class, 'index']);
Route::get('/courses/{course}/modules/{module}', [ModuleController::class, 'show']);
Route::put('/courses/{course}/modules/{module}', [ModuleController::class, 'update']);
Route::post('/courses/{course}/modules', [ModuleController::class, 'store']);
Route::delete('/courses/{course}/modules/{module}', [ModuleController::class, 'destroy']);

/** Módulos - Lições */
Route::get('/courses/{course}/modules/{module}/lessons', [LessonController::class, 'index']);
Route::get('/courses/{course}/modules/{module}/lessons/{lesson}', [LessonController::class, 'show']);
Route::put('/courses/{course}/modules/{module}/lessons/{lesson}', [LessonController::class, 'update']);
Route::post('/courses/{course}/modules/{module}/lessons', [LessonController::class, 'store']);
Route::delete('/courses/{course}/modules/{module}/lessons/{lesson}', [LessonController::class, 'destroy']);