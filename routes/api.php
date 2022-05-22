<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBankController;
use App\Http\Controllers\ApiCourseController;
use App\Http\Controllers\ApiQuestionController;
use App\Http\Controllers\ApiImageController;

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

//--------------------------------------------------------------------------------

// authentication routes
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function() {
    // common routes
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/myCourses', [ApiCourseController::class, 'myCourses']);
    Route::get('/courses/show/{id}', [ApiCourseController::class, 'show'])->middleware('active-course', 'related-course');

    // teacher routes
    Route::middleware('is-teacher')->group(function() {
        Route::post('/courses/create', [ApiCourseController::class, 'store']);
        Route::middleware('related-course')->group(function() {
            Route::post('/courses/edit/{id}', [ApiCourseController::class, 'update']);
            Route::post('/courses/manage-status/{id}', [ApiCourseController::class, 'manageStatus']);
            Route::get('/courses/{id}/banks', [ApiBankController::class, 'banks']);
            Route::post('/courses/{id}/banks/create', [ApiBankController::class, 'store']);
        });

        Route::middleware('related-bank')->group(function() {
            Route::get('/banks/show/{id}', [ApiBankController::class, 'show']);
            Route::get('/banks/edit/{id}', [ApiBankController::class, 'update']);
            Route::get('/banks/{id}/questions', [ApiQuestionController::class, 'questions']);
            Route::post('/banks/{id}/questions/create', [ApiQuestionController::class, 'store']);
        });

        Route::middleware('related-question')->group(function() {
            Route::get('/questions/show/{id}', [ApiQuestionController::class, 'show']);
            Route::post('/questions/edit/{id}', [ApiQuestionController::class, 'update']);
        });

        Route::middleware('related-image')->group(function() {
            Route::post('/images/delete/{id}', [ApiImageController::class, 'delete']);
        });
    });
    
    // student routes
    Route::middleware('is-student')->group(function() {
        Route::get('/courses/search/{keyword}', [ApiCourseController::class, 'search']);
        Route::post('/courses/join/{id}', [ApiCourseController::class, 'join'])->middleware('active-course');
    });
});

// adel@shakel.com  =>  1|dOP7h59mJG1ZBYbBNh8qWShaXHiLUBcMirVP7llT

// eleanora56@example.com  =>  2|8uuBrjccjNQSRQEPSzukeTKjacq9TB7wpMiYltIO