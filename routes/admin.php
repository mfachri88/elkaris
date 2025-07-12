<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageMaterialController;
use App\Http\Controllers\Admin\ManageExerciseController;
use App\Http\Controllers\Admin\CareerTestController;
use App\Http\Controllers\Admin\ManageCareerTestController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\ReportsController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Career Test Management - Modified to fix routing issue
Route::group(['prefix' => 'career-test', 'as' => 'career-test.'], function () {
    // Base route for listing tests
    Route::get('/', [CareerTestController::class, 'index'])->name('index');
    
    // Management routes
    Route::get('manage', [ManageCareerTestController::class, 'index'])->name('manage');
    Route::post('manage/store', [ManageCareerTestController::class, 'store'])->name('manage.store');
    Route::get('manage/seed', [ManageCareerTestController::class, 'seedDefaultQuestions'])->name('manage.seed');
    Route::get('manage/{id}', [ManageCareerTestController::class, 'getQuestion'])->name('manage.get');
    Route::put('manage/{id}', [ManageCareerTestController::class, 'update'])->name('manage.update');
    Route::delete('manage/{id}', [ManageCareerTestController::class, 'destroy'])->name('manage.destroy');
    
    // Other career test routes
    Route::get('statistics', [CareerTestController::class, 'statistics'])->name('statistics');
    Route::get('{id}', [CareerTestController::class, 'show'])->name('show')->where('id', '[0-9]+');
    Route::delete('{id}', [CareerTestController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
});

