<?php

use App\Http\Controllers\PseudoNameController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
  return 'Hello World';
});

Route::prefix('/pseudo-names')->group(function () {
  Route::controller(PseudoNameController::class)->group(function () {
    Route::get('/available', 'available');
  });
});

Route::controller(UserController::class)->group(function () {
  Route::get('/register', 'register');
  Route::post('/users', 'store');
});

