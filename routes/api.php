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

// Route::group(function(){
//     Route::get('reseps', ResepsController::class);
// });


Route::get('/reseps', [ResepController::class, 'index']);
Route::get('/reseps/search', [ResepController::class, 'search']);
Route::get('/reseps/{id}', [ResepController::class, 'show']);
Route::post('/reseps', [ResepController::class, 'store']);
Route::put('/reseps/{id}', [ResepController::class, 'update']);
Route::delete('/reseps/{id}', [ResepController::class, 'destroy']);
Route::post('/reseps/{id}', [ResepController::class, 'update']);
Route::post('/reseps/{id}/bookmark', [ResepController::class, 'bookmark']);
Route::get('/reseps/{id}/bookmark', [ResepController::class, 'bookmark']);
Route::delete('/reseps/{id}/bookmark', [ResepController::class, 'remove']);

Route::post('/reseps/{id}/approve', [ResepController::class, 'approve']);
Route::get('/reseps/{id}/approve', [ResepController::class, 'approve']);
Route::delete('/reseps/{id}/approve', [ResepController::class, 'remove']);

Route::get('/histories', [HistoryController::class, 'index']);
Route::get('/histories/{id}', [HistoryController::class, 'show']);
Route::post('/histories', [HistoryController::class, 'store']);
Route::post('/histories/{id}', [HistoryController::class, 'show']);
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

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

// Route::post('/registerAdmin', App\Http\Controllers\Api\RegisterAdminController::class)->name('registerAdmin');
// Route::post('/loginAdmin', App\Http\Controllers\Api\LoginAdminController::class)->name('loginAdmin');

Route::post('/registerAdmin', [AdminController::class, 'register']);
Route::post('/loginAdmin', [AdminController::class, 'login']);
Route::get('/admin', [AdminController::class, 'index']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->get('/admin', function (Request $request) {
//     return $request->user();
// });

Route::get('/admin/session', function (Request $request) {
    $admin = $request->session()->get('admin');
    return response()->json(['name' => $admin->name]);
});


// Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
//     Route::get('/loginAdmin', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
//     Route::post('/loginAdmin', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
 
//     Route::group(['middleware' => 'adminauth'], function () {
//         Route::get('/', function () {
//             return view('welcome');
//         })->name('DashboardAdmin');
 
//     });
// });

// Route::prefix('admin')->group(function () {
//     Route::post('register', 'AdminController@register');
//     Route::post('login', 'AdminController@login');
// });