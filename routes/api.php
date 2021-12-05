<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController
};

/** Cursos */
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/{course}', [CourseController::class, 'show']);
Route::put('/course/{course}', [CourseController::class, 'update']);
Route::post('/course', [CourseController::class, 'store']);
Route::delete('/course/{course}', [CourseController::class, 'destroy']);

/** Cursos - Módulos */
Route::get('/course/{course}/modules', [ModuleController::class, 'index']);
Route::get('/course/{course}/module/{module}', [ModuleController::class, 'show']);
Route::put('/module/{module}', [ModuleController::class, 'update']);
Route::post('/module', [ModuleController::class, 'store']);
Route::delete('/module/{module}', [ModuleController::class, 'destroy']);

/** Módulos - Lições */
Route::get('/module/{module}/lessons', [LessonController::class, 'index']);
Route::get('/module/{module}/lesson/{lesson}', [LessonController::class, 'show']);
Route::put('/lesson/{lesson}', [LessonController::class, 'update']);
Route::post('/lesson', [LessonController::class, 'store']);
Route::delete('/lesson/{lesson}', [LessonController::class, 'destroy']);