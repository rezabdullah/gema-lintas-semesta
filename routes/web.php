<?php

use App\Http\Controllers\backoffice\AuthController;
use App\Http\Controllers\backoffice\CargoController;
use App\Http\Controllers\backoffice\CostRateController;
use App\Http\Controllers\backoffice\DashboardController;
use App\Http\Controllers\backoffice\PartnerController;
use App\Http\Controllers\backoffice\RoleController;
use App\Http\Controllers\backoffice\UserController;
use App\Http\Controllers\backoffice\WarehouseController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FrontController;
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

Route::get('/', function () { return view('index'); })->name('front.index');
Route::get('/profil', function () { return view('profile'); })->name('front.profile');
Route::get('/layanan', function () { return view('service'); })->name('front.service');
Route::get('/ketentuan', function () { return view('terms'); })->name('front.terms');
Route::get('/kontak', function () { return view('contact'); })->name('front.contact');

Route::post('/tracking', [FrontController::class, 'trackingPost'])->name('front.tracking.post');
Route::get('/tracking/{cargo}', [FrontController::class, 'trackingGet'])->name('front.tracking.get');

Route::prefix('/ajax')->group(function () {
    Route::get('/province', [AjaxController::class, 'provinces'])->name('ajax.province');
    Route::get('/cities', [AjaxController::class, 'cities'])->name('ajax.cities');
    Route::get('/districts', [AjaxController::class, 'districts'])->name('ajax.districts');

    Route::middleware('auth')->group(function () {
        Route::get('/partner', [AjaxController::class, 'partner'])->name('ajax.partner');
    });
});

Route::prefix('/bo')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index')->middleware('guest');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login')->middleware('guest');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard-tracking-shipments', [DashboardController::class, 'trackingShipment'])->name('dashboard.tracking.shipments');

        Route::get('/shipments', [CargoController::class, 'index'])->name('shipments')->middleware('permission:view shipment');
        Route::get('/shipments/pickup', [CargoController::class, 'createPickup'])->name('shipments.pickup.create')->middleware('permission:create pickup shipment');
        Route::post('/shipments/pickup', [CargoController::class, 'storePickup'])->name('shipments.pickup.store')->middleware('permission:create pickup shipment');
        Route::get('/shipments/{cargo}', [CargoController::class, 'show'])->name('shipments.show')->middleware('permission:view shipment');
        Route::get('/shipments/{cargo}/print', [CargoController::class, 'printDelivery'])->name('shipments.delivery.print')->middleware('permission:view delivery shipment');
        Route::get('/shipments/{cargo}/create', [CargoController::class, 'createDelivery'])->name('shipments.delivery.create')->middleware('permission:create delivery shipment');
        Route::post('/shipments/{cargo}', [CargoController::class, 'storeDelivery'])->name('shipments.delivery.store')->middleware('permission:create delivery shipment');
        Route::delete('/shipments/{cargoDetail}/destroy', [CargoController::class, 'destroyDelivery'])->name('shipments.delivery.destroy')->middleware('permission:delete delivery shipment');

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
        Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:manage admin role');

        Route::get('/change-password', [AuthController::class, 'editPassword'])->name('change-password.edit');
        Route::patch('/change-password', [AuthController::class, 'updatePassword'])->name('change-password.update');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
