<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBankController;
use App\Http\Controllers\ApiChoiceController;
use App\Http\Controllers\ApiCourseController;
use App\Http\Controllers\ApiExamController;
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

    Route::middleware('related-course', 'active-course')->group(function() {
        Route::get('/courses/show/{course_id}', [ApiCourseController::class, 'show']);
        Route::get('/courses/{course_id}/exams', [ApiExamController::class, 'exams']);
    });

    Route::middleware('related-exam')->group(function() {
        Route::get('/exams/show/{exam_id}', [ApiExamController::class, 'show']);
    });

    // teacher routes
    Route::middleware('is-teacher')->group(function() {
        // courses actions
        Route::post('/courses/create', [ApiCourseController::class, 'store']);
        Route::middleware('related-course')->group(function() {
            Route::post('/courses/edit/{course_id}', [ApiCourseController::class, 'update']);
            Route::post('/courses/manage-status/{course_id}', [ApiCourseController::class, 'manageStatus']);

            Route::get('/courses/{course_id}/banks', [ApiBankController::class, 'banks']);

            Route::post('/courses/{course_id}/banks/create', [ApiBankController::class, 'store']);
            Route::post('/courses/{course_id}/exams/create', [ApiExamController::class, 'store']);
        });

        // banks actions
        Route::middleware('related-bank')->group(function() {
            Route::get('/banks/show/{bank_id}', [ApiBankController::class, 'show']);
            Route::post('/banks/edit/{bank_id}', [ApiBankController::class, 'update']);

            Route::get('/banks/{bank_id}/questions', [ApiQuestionController::class, 'questions']);
            Route::post('/banks/{bank_id}/questions/create', [ApiQuestionController::class, 'store']);
        });

        // questions actions
        Route::middleware('related-question')->group(function() {
            Route::get('/questions/show/{question_id}', [ApiQuestionController::class, 'show']);
            Route::post('/questions/edit/{question_id}', [ApiQuestionController::class, 'update']);
            
            Route::post('/questions/{question_id}/choices/create', [ApiChoiceController::class, 'store']);
        });

        // questions' images actions
        Route::middleware('related-image')->group(function() {
            Route::get('/images/delete/{image_id}', [ApiImageController::class, 'delete']);
        });

        // questions' choices actions
        Route::middleware('related-choice')->group(function() {
            Route::get('/choices/show/{choice_id}', [ApiChoiceController::class, 'show']);
            Route::post('/choices/edit/{choice_id}', [ApiChoiceController::class, 'update']);
        });

        // exams actions
        Route::middleware('related-exam')->group(function() {
            Route::post('/exams/edit/{exam_id}', [ApiExamController::class, 'update']);
            
            Route::post('/exams/{exam_id}/add-question/{question_id}', [ApiExamController::class, 'addQuestion'])->middleware('related-question', 'course-question');
            Route::post('/exams/{exam_id}/add-bank/{bank_id}', [ApiExamController::class, 'addBank'])->middleware('related-bank', 'course-bank');
        });
    });
    
    // student routes
    Route::middleware('is-student')->group(function() {
        Route::get('/courses/search/{keyword}', [ApiCourseController::class, 'search']);
        Route::post('/courses/join/{course_id}', [ApiCourseController::class, 'join'])->middleware('active-course');

        Route::middleware('related-exam', 'active-exam')->group(function() {
            Route::post('/exams/{exam_id}/start', [ApiExamController::class, 'start']);
            Route::middleware('started-exam')->group(function() {
                Route::get('/exams/{exam_id}/questions', [ApiExamController::class, 'show']);
            });
        });
    });
});

// adel@shakel.com  =>  1|mzivF3UgUgLe9Y4MIWxeRWcJ08Y8mQ7ZA4db5n9D

// iliana.rice@example.org  =>  2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk