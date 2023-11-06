<?php

use App\Http\Controllers\ResepController;
use App\Http\Controllers\ResepsController;
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

Route::get('list', [ResepController::class, 'index']);

// Route::get('/', [ResepsController::class, 'index']);
