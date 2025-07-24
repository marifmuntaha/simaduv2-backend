<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Institution\ProgramController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\Master\LadderController;
use App\Http\Controllers\Master\LevelController;
use App\Http\Controllers\Master\MajorController;
use App\Http\Controllers\Master\YearController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('/master/ladder', LadderController::class);
    Route::apiResource('/master/level', LevelController::class);
    Route::apiResource('/master/major', MajorController::class);
    Route::apiResource('/master/year', YearController::class);
    Route::apiResource('/institution/program', ProgramController::class);
    Route::apiResource('/institution', InstitutionController::class);
    Route::apiResource('/student', StudentController::class);
    Route::apiResource('/teacher', TeacherController::class);
    Route::apiResource('/notifications', NotificationController::class)->only(['index', 'update']);
});
