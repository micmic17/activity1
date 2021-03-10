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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // Public routes
    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login'])->name('login.api');
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->name('logout.api')->middleware('auth:api');

    // Authenticated Routes
    Route::group(['middleware' => ['api.admin']], function () {
        Route::apiResource('company', App\Http\Controllers\API\CompanyController::class);
        Route::apiResource('employee', App\Http\Controllers\API\EmployeeController::class);
    });
});