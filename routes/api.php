<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\AuthController;

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

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'loginUser']);




Route::group(['middleware' => ['auth:sanctum']], function () {
    //route for submiting a parcel
    Route::post('/submit', [ServiceController::class, 'submitParcel']); 
    Route::get('/statusCheck', [ServiceController::class, 'checkStatus']);
    Route::get('/status', [ServiceController::class, 'parcelStatus']);
    //protected route for login out
    Route::post('/logout', [AuthController::class, 'logoutUser']);
  });
