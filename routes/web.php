<?php

use App\Http\Controllers\Admin\AspirationController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityCategoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TaskCategoryController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Student\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('landing.index');
});
Route::get('/landing', [LandingController::class, 'index'])->name('landing.index');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'add'])->name('add');
        Route::post('/create', [UserController::class, 'doCreate'])->name('create');
        Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');
        Route::get('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/update/{id}', [UserController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::post('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('resetPassword');
    });

    Route::prefix('task-categories')->name('task_categories.')->group(function () {
        Route::get('/', [TaskCategoryController::class, 'index'])->name('index');
        Route::get('/add', [TaskCategoryController::class, 'add'])->name('add');
        Route::post('/create', [TaskCategoryController::class, 'doCreate'])->name('create');
        Route::get('/update/{id}', [TaskCategoryController::class, 'update'])->name('update');
        Route::post('/update/{id}', [TaskCategoryController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [TaskCategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/add', [TaskController::class, 'add'])->name('add');
        Route::post('/create', [TaskController::class, 'doCreate'])->name('do_create');
        Route::get('/update/{id}', [TaskController::class, 'update'])->name('update');
        Route::post('/update/{id}', [TaskController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('delete');
    });

    Route::prefix('classrooms')->name('classrooms.')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->name('index');
        Route::post('/create', [ClassroomController::class, 'doCreate'])->name('do_create');
        Route::post('/update/{id}', [ClassroomController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [ClassroomController::class, 'delete'])->name('delete');
    });

    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/add', [StudentController::class, 'add'])->name('add');
        Route::post('/create', [StudentController::class, 'doCreate'])->name('do_create');
        Route::get('/update/{id}', [StudentController::class, 'update'])->name('update');
        Route::post('/update/{id}', [StudentController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [StudentController::class, 'delete'])->name('delete');
        Route::post('/reset-password/{id}', [StudentController::class, 'doResetPassword'])->name('doResetPassword');
    });

    Route::prefix('locations')->name('locations.')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('index');
        Route::post('/create', [LocationController::class, 'doCreate'])->name('do_create');
        Route::post('/update/{id}', [LocationController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [LocationController::class, 'delete'])->name('delete');
    });

    Route::prefix('facility-categories')->name('facility-categories.')->group(function () {
        Route::get('/', [FacilityCategoryController::class, 'index'])->name('index');
        Route::get('/add', [FacilityCategoryController::class, 'add'])->name('add');
        Route::post('/create', [FacilityCategoryController::class, 'doCreate'])->name('do_create');
        Route::get('/update/{id}', [FacilityCategoryController::class, 'update'])->name('update');
        Route::post('/update/{id}', [FacilityCategoryController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [FacilityCategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('aspirations')->name('aspirations.')->group(function () {
        Route::get('/', [AspirationController::class, 'index'])->name('index');
        Route::get('/export-pdf', [AspirationController::class, 'exportPdf'])->name('export_pdf');
        Route::get('/add', [AspirationController::class, 'add'])->name('add');
        Route::post('/create', [AspirationController::class, 'doCreate'])->name('do_create');
        Route::get('/detail/{id}', [AspirationController::class, 'detail'])->name('detail');
        Route::post('/update/{id}', [AspirationController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [AspirationController::class, 'delete'])->name('delete');
    });
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change_password');
        Route::post('/change-password', [UserController::class, 'doChangePassword'])->name('do_change_password');
    });
});

Route::middleware(['auth', 'role:2'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('complaints')->name('complaints.')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('index');
        Route::get('/add', [ComplaintController::class, 'add'])->name('add');
        Route::post('/create', [ComplaintController::class, 'doCreate'])->name('do_create');
        Route::get('/detail/{id}', [ComplaintController::class, 'detail'])->name('detail');
        Route::get('/update/{id}', [ComplaintController::class, 'update'])->name('update');
        Route::post('/update/{id}', [ComplaintController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [ComplaintController::class, 'delete'])->name('delete');
    });
});
