<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ModeController;

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
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

Route::resource('settings/status', StatusController::class);

Route::resource('settings/type', TypeController::class);

Route::resource('settings/mode', ModeController::class);

Route::resource('shipments', ShipmentController::class);
Route::post('shipments/existingsender', [ShipmentController::class, 'existingsender'])->name('shipments.existingsender');
Route::post('shipments/newsender', [ShipmentController::class, 'newsender'])->name('shipments.newsender');
Route::get('shipments/{sender}/create_step2', [ShipmentController::class, 'create_step2'])->name('shipments.create_step2');
Route::post('shipments/existingreceiver', [ShipmentController::class, 'existingreceiver'])->name('shipments.existingreceiver');
Route::post('shipments/newreceiver', [ShipmentController::class, 'newreceiver'])->name('shipments.newreceiver');
Route::get('shipments/{sender}/{receiver}/create_step3', [ShipmentController::class, 'create_step3'])->name('shipments.create_step3');
Route::get('shipments/{shipment:tracking_code}/create_step4', [ShipmentController::class, 'create_step4'])->name('shipments.create_step4');
Route::post('shipments/{id}/store_cargo_item', [ShipmentController::class, 'store_cargo_item'])->name('shipments.store_cargo_item');
Route::get('shipments/{shipment:tracking_code}/', [ShipmentController::class, 'show'])->name('shipments.show');