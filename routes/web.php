<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ShipmentController;

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

Route::resource('settings/status', StatusController::class);

Route::resource('settings/type', TypeController::class);

Route::resource('settings/mode', ModeController::class);

Route::resource('shipments', ShipmentController::class);
Route::post('shipments/existingsender', [ShipmentController::class, 'existingsender'])->name('shipments.existingsender');
Route::post('shipments/newsender', [ShipmentController::class, 'newsender'])->name('shipments.newsender');