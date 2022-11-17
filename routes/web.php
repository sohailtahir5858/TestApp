<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Auth;
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

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Declaring Auth route and also ensuring Registration route is disabled.
Auth::routes([
    'register' => false, // Routes of Registration
  ]);

// Resource Controllers for Company and Employees,
// which can only be accessed if user is authenticated.
Route::middleware('auth')->group( function () {
  Route::resource('/companies', CompaniesController::class);
  Route::resource('/employees', EmployeesController::class);
});

// Route for home/Dashboard. it uses middleware in its constructor.
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route for switching btw different languages defined in config.languages.php
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);