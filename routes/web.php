<?php

use App\Http\Controllers\backoffice\AuthController;
use App\Http\Controllers\backoffice\CostRateController;
use App\Http\Controllers\backoffice\DashboardController;
use App\Http\Controllers\backoffice\PartnerController;
use App\Http\Controllers\backoffice\RoleController;
use App\Http\Controllers\backoffice\UserController;
use App\Http\Controllers\backoffice\WarehouseController;
use App\Http\Controllers\DistrictController;
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

Route::prefix('/ajax')->group(function () {
    Route::get('/province', [DistrictController::class, 'province'])->name('ajax.province');
    Route::get('/cities', [DistrictController::class, 'cities'])->name('ajax.cities');
    Route::get('/districts', [DistrictController::class, 'districts'])->name('ajax.districts');
});

Route::prefix('/bo')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login')->middleware('guest');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/cost-rates', [CostRateController::class, 'index'])->name('cost-rates')->middleware('permission:view cost rate');
        Route::get('/cost-rates/create', [CostRateController::class, 'create'])->name('cost-rates.create')->middleware('permission:add cost rate');
        Route::post('/cost-rates', [CostRateController::class, 'store'])->name('cost-rates.store')->middleware('permission:add cost rate');
        Route::get('/cost-rates/{costRate}/edit', [CostRateController::class, 'edit'])->name('cost-rates.edit')->middleware('permission:edit cost rate');
        Route::patch('/cost-rates/{costRate}', [CostRateController::class, 'update'])->name('cost-rates.update')->middleware('permission:edit cost rate');
        Route::delete('/cost-rates/{costRate}', [CostRateController::class, 'destroy'])->name('cost-rates.destroy')->middleware('permission:delete cost rate');

        Route::get('/partners', [PartnerController::class, 'index'])->name('partners')->middleware('permission:view partner');
        Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create')->middleware('permission:add partner');
        Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store')->middleware('permission:add partner');
        Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit')->middleware('permission:edit partner');
        Route::patch('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update')->middleware('permission:edit partner');
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy')->middleware('permission:delete partner');
        
        Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses')->middleware('permission:view warehouse');
        Route::get('/warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create')->middleware('permission:add warehouse');
        Route::post('/warehouses', [WarehouseController::class, 'store'])->name('warehouses.store')->middleware('permission:add warehouse');
        Route::get('/warehouses/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('warehouses.edit')->middleware('permission:edit warehouse');
        Route::patch('/warehouses/{warehouse}', [WarehouseController::class, 'update'])->name('warehouses.update')->middleware('permission:edit warehouse');
        Route::delete('/warehouses/{warehouse}', [WarehouseController::class, 'destroy'])->name('warehouses.destroy')->middleware('permission:delete warehouse');

        Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('permission:view admin');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:add admin');
        Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('permission:add admin');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit admin');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit admin');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete admin');

        Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('permission:view admin role');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:manage admin role');
        Route::patch('/roles/{user}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:manage admin role');
    });
});
