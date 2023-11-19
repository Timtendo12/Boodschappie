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

Route::prefix('app')->group(function () {

    /*
     * Index
     */
    Route::get('/', [IndexController::class, 'index']);

    /*
     * Session
     */
    Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
    Route::post('/register', [SessionController::class, 'create'])->middleware('guest');
    Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

});
