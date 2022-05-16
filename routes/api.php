<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiCourseController;

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

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    Route::get('/courses/search/{keyword}', [ApiCourseController::class, 'search']);
    Route::post('/courses/create', [ApiCourseController::class, 'store']);
    Route::post('/courses/edit/{id}', [ApiCourseController::class, 'update']);
    Route::post('/courses/manage-status/{id}', [ApiCourseController::class, 'manageStatus']);

    Route::middleware('active-course')->group(function() {
        Route::get('/courses/show/{id}', [ApiCourseController::class, 'show']);
        Route::post('/courses/join/{id}', [ApiCourseController::class, 'join']);
    });
});

// adel@shakel.com  =>  1|zUBkkixz6IcRCxPfOBK3eK8xURfWDTLSSuNuPodH