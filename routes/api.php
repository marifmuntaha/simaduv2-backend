<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Finance\AccountController;
use App\Http\Controllers\Finance\ItemController;
use App\Http\Controllers\Institution\ProgramController;
use App\Http\Controllers\Institution\RombelController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\Master\LadderController;
use App\Http\Controllers\Master\LevelController;
use App\Http\Controllers\Master\MajorController;
use App\Http\Controllers\Master\YearController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Student\ActivityController;
use App\Http\Controllers\Student\AddressController;
use App\Http\Controllers\Student\MutationController;
use App\Http\Controllers\Student\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//sleep(1);

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'master'], function () {
        Route::apiResource('ladder', LadderController::class);
        Route::apiResource('level', LevelController::class);
        Route::apiResource('major', MajorController::class);
        Route::apiResource('year', YearController::class);
    });
    Route::group(['prefix' => 'institution'], function () {
        Route::apiResource('rombel', RombelController::class);
        Route::apiResource('program', ProgramController::class);
    });
    Route::apiResource('institution', InstitutionController::class);
    Route::group(['prefix' => 'student'], function () {
        Route::apiResource('activity', ActivityController::class);
        Route::apiResource('address', AddressController::class);
        Route::apiResource('parent', ParentController::class);
        Route::apiResource('mutation', MutationController::class);
    });
    Route::apiResource('/student', StudentController::class);
    Route::apiResource('/teacher', TeacherController::class);
    Route::apiResource('/user', UserController::class);
    Route::apiResource('/notification', NotificationController::class)->only(['index', 'update']);
    Route::group(['prefix' => 'finance'], function () {
        Route::apiResource('account', AccountController::class);
        Route::apiResource('item', ItemController::class);
    });
});
