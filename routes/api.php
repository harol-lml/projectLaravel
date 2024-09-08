<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group([
    'middleware' => ['auth:api'],// 'api',
    'prefix' => 'departments'
], function ($router) {
    Route::get('/', [DepartmentController::class, 'all'])->name('departments.all');
    Route::get('/{id}', [DepartmentController::class, 'find'])->name('departments.find');
    Route::post('/', [DepartmentController::class, 'create'])->name('departments.create'); // Crear departamento
    Route::put('/{id}', [DepartmentController::class, 'update'])->name('departments.update'); // Actualizar departamento
    Route::delete('/{id}', [DepartmentController::class, 'delete'])->name('departments.delete'); // Eliminar departamento
});

Route::group([
    'middleware' => ['auth:api'],// 'api',
    'prefix' => 'users'
], function ($router) {
    Route::get('/', [UserController::class, 'all'])->name('users.all');
    Route::get('/{id}', [UserController::class, 'find'])->name('users.find');
    Route::post('/', [UserController::class, 'create'])->name('users.create'); // Crear usario
    // Route::put('/{id}', [UserController::class, 'update'])->name('users.update'); // Actualizar usario
    Route::delete('/{id}', [UserController::class, 'delete'])->name('users.delete'); // Eliminar usario
});