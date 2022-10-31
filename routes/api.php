<?php

use App\Http\Controllers\AppointementController;
use App\Http\Controllers\MaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('profile', 'profile');
    Route::post('update-profile/{id}', 'updateProfile');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::apiResource('materials', MaterialController::class);
Route::apiResource('comments', AppointementController::class);
 