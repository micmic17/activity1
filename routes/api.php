<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // Public routes
    Route::get('/login', 'App\Http\Controllers\API\AuthController@login')->name('login.api');

    // Authenticated Routes
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/logout', 'App\Http\Controllers\API\AuthController@logout')->name('logout.api');

        Route::resource('company', App\Http\Controllers\CompanyController::class);
        // Route::resource('employee', App\Http\Controllers\EmployeeController::class);
    });
});