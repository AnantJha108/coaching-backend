<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,"register"]);
Route::post('/login',[AuthController::class,"login"]);
Route::get('/students',[StudentController::class,"index"]);
Route::post('/students/store',[StudentController::class,"store"]);
Route::delete('/students/delete/{s}',[StudentController::class,"destroy"]);
Route::post('/students/update/{s}',[StudentController::class,"update"]);
Route::post('/courses/store',[CourseController::class,"store"]);
Route::get('/courses',[CourseController::class,"index"]);
Route::delete('/courses/delete/{c}',[CourseController::class,"destroy"]);
Route::post('/courses/update/{c}',[CourseController::class,"update"]);
// Route::apiResource('students',StudentController::class);