<?php

use App\Http\Controllers\backoffice\AuthController;
use App\Http\Controllers\backoffice\DashboardController;
use App\Http\Controllers\backoffice\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/bo')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login')->middleware('guest');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class, [
            'names' => [
                'index' => 'users',
                'store' => 'users.store',
                'create' => 'users.create',
                'edit' => 'users.edit',
                'update' => 'users.update',
                'destroy' => 'users.destroy',
            ],
            'except' => [ 'show' ]
        ]);
    });
});
