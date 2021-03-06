<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\QuantityTypeController;
use App\Http\Controllers\AddressBookController;
use App\Http\Controllers\AccountController;

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

Route::resource('settings/quantity_types', QuantityTypeController::class);

Route::resource('shipments', ShipmentController::class);
Route::post('shipments/existingsender', [ShipmentController::class, 'existingsender'])->name('shipments.existingsender');
Route::post('shipments/newsender', [ShipmentController::class, 'newsender'])->name('shipments.newsender');
Route::get('shipments/{sender}/create_step2', [ShipmentController::class, 'create_step2'])->name('shipments.create_step2');
Route::post('shipments/existingreceiver', [ShipmentController::class, 'existingreceiver'])->name('shipments.existingreceiver');
Route::post('shipments/newreceiver', [ShipmentController::class, 'newreceiver'])->name('shipments.newreceiver');
Route::get('shipments/{sender}/{receiver}/create_step3', [ShipmentController::class, 'create_step3'])->name('shipments.create_step3');
Route::get('shipments/{shipment:tracking_code}/create_step4', [ShipmentController::class, 'create_step4'])->name('shipments.create_step4');
Route::post('shipments/{shipment:tracking_code}/store_cargo_item', [ShipmentController::class, 'store_cargo_item'])->name('shipments.store_cargo_item');
Route::delete('shipments/{item}/delete_item', [ShipmentController::class, 'destroy_item'])->name('shipments.destroy_item');
Route::put('shipments/{shipment:tracking_code}/confirmation', [ShipmentController::class, 'confirmation'])->name('shipments.confirmation');
Route::get('shipments/{shipment:tracking_code}/', [ShipmentController::class, 'show'])->name('shipments.show');
Route::post('shipments/{shipment:tracking_code}/store_location', [ShipmentController::class, 'store_location'])->name('shipments.store_location');
Route::put('shipments/location/{location}/update', [ShipmentController::class, 'update_location'])->name('shipments.update_location');
Route::delete('shipments/{location}/delete_location', [ShipmentController::class, 'destroy_location'])->name('shipments.destroy_location');
Route::post('shipments/search/', [ShipmentController::class, 'search'])->name('shipments.search');
Route::get('shipments/list/{type?}', [ShipmentController::class, 'list'])->name('shipments.list');

Route::get('shipment/', [ShipmentController::class, 'track'])->name('shipments.track');

Route::get('address_book/{type?}', [AddressBookController::class, 'index'])->name('address_book');
Route::post('address_book', [AddressBookController::class, 'store'])->name('address_book.store');
Route::put('address_book/{id}/update', [AddressBookController::class, 'update'])->name('address_book.update');
Route::post('address_book/search/{type?}', [AddressBookController::class, 'search'])->name('address_book.search');

Route::get('account/profile/{account:username}', [AccountController::class, 'profile'])->name('account.profile');
Route::put('account/profile/{account:username}', [AccountController::class, 'update'])->name('account.update');
Route::put('account/change_password/{account:username}', [AccountController::class, 'change_password'])->name('account.change_password');