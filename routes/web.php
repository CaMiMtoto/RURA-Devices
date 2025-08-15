<?php

use App\Http\Controllers\UsersController;
use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\PasswordChanged;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', PasswordChanged::class, EnsureUserIsActive::class], 'prefix' => '/admin', 'as' => 'admin.'], function () {

    Route::get('/my-assets',[\App\Http\Controllers\AssetController::class,'myAssets'])->name('my-assets');
    Route::post('/confirm-assets',[\App\Http\Controllers\AssetController::class,'confirmAssets'])->name('my-assets.confirmation');

    Route::group(['prefix' => "settings", "as" => "settings."], function () {
        Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments.index');
        Route::post('/departments', [App\Http\Controllers\DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/departments/{department}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('departments.show');
        Route::delete('/departments/{department}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('departments.destroy');

        Route::get('/job-titles', [App\Http\Controllers\JobTitleController::class, 'index'])->name('job-titles.index');
        Route::post('/job-titles', [App\Http\Controllers\JobTitleController::class, 'store'])->name('job-titles.store');
        Route::get('/job-titles/{jobTitle}', [App\Http\Controllers\JobTitleController::class, 'show'])->name('job-titles.show');
        Route::delete('/job-titles/{jobTitle}', [App\Http\Controllers\JobTitleController::class, 'destroy'])->name('job-titles.destroy');

    });


    Route::group(["prefix" => "system", "as" => "system."], function () {
        Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
        Route::post('/roles', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}', [App\Http\Controllers\RolesController::class, 'show'])->name('roles.show');
        Route::delete('/roles/{role}', [App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.destroy');


        Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
        Route::post('/users', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store');
        Route::post('/users/{user}/toggle-activate', [App\Http\Controllers\UsersController::class, 'toggleActive'])->name('users.active-toggle');
        Route::delete('/users/{user}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{user}', [App\Http\Controllers\UsersController::class, 'show'])->name('users.show');
        Route::post('/users/import', [UsersController::class, 'import'])->name('users.import');
        Route::get('/permissions', [App\Http\Controllers\PermissionsController::class, 'index'])->name('permissions.index');

    });


    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');



    Route::prefix('reports')->group(function () {

    });


});
