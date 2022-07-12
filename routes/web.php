<?php

use App\Http\Controllers\StocksController;
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


// Stock Management
Route::get('/', [StocksController::class, 'index'])
    ->name('stocks');

Route::get('stocks', [StocksController::class, 'index'])
    ->name('stocks.mainPage');

Route::post('stocks', [StocksController::class, 'calculate'])
    ->name('stocks.calculate');
