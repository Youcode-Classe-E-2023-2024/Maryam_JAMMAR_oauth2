<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(RoleController::class)->group(function() {
    Route::get('/roles', 'index');
    Route::get('/role/{id}', 'show');
});

Route::controller(RoleController::class)->group(function() {
    Route::post('/role', 'store');
    Route::post('/role/{id}', 'update');
    Route::delete('/role/{id}', 'destroy');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/users', 'index');
    Route::get('/user/{id}', 'show');
    Route::post('/user', 'store');
    Route::post('/user/{id}', 'update');
    Route::delete('/user/{id}', 'destroy');
});
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(function () {
    
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('signup', [AuthController::class, 'register']);
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function () {

        Route::get('helloworld', 'AuthController@index');

    });
});

