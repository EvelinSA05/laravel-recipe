<?php

use Illuminate\Http\Request;

use App\Http\Controllers\ResepController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(function(){
//     Route::get('reseps', ResepsController::class);
// });

Route::get('/reseps', [ResepController::class, 'index']);
Route::get('/reseps/{id}', [ResepController::class, 'show']);
Route::post('/reseps', [ResepController::class, 'store']);
Route::delete('/reseps/{id}', [ResepController::class, 'destroy']);
Route::post('/reseps/{id}', [ResepController::class, 'update']);

Route::get('/histories', [HistoryController::class, 'index']);
Route::post('/histories', [HistoryController::class, 'store']);
Route::delete('/histories/{id}', [HistoryController::class, 'destroy']);
Route::post('/histories/{id}', [HistoryController::class, 'update']);

Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin', [AdminController::class, 'store']);
Route::delete('/admin/{id}', [AdminController::class, 'destroy']);
Route::post('/admin/{id}', [AdminController::class, 'update']);

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
Route::post('/user/{id}', [UserController::class, 'update']);
