<?php

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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['web']], function() {
    Route::resources([
        'company' => App\Http\Controllers\CompanyController::class,
        'employee' => App\Http\Controllers\EmployeeController::class,
        // '/employee/search/comap' => App\Http\Controllers\EmployeeController::class,
    ]);

    // Route::get('/home', [App\Http\Controllers\EmployeeController::class, 'searchEmployee'])->name('search.employee');
});