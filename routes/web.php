<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SessionController;
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

Route::get('/', [IndexController::class, 'index']);
Route::get('/hoe-werkt-het', [IndexController::class, 'tutorial']);

Route::get('/verify-email', [SessionController::class, 'verifyEmail']);

Route::prefix('app')->group(function () {

    /*
     * Index
     */
    Route::get('/', [IndexController::class, 'index'])->middleware('auth');

    /*
     * Session
     */
    Route::get('/login', [SessionController::class, 'login'])->middleware('guest')->name('login');
    Route::post('/login', [SessionController::class, 'store'])->middleware('guest');

    Route::get('/register', [SessionController::class, 'register'])->middleware('guest')->name('register');
    Route::post('/register', [SessionController::class, 'create'])->middleware('guest');

    Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

});
