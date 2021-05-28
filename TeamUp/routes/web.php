<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::post('/profile/{id}/update', [\App\Http\Controllers\ProfileController::class, 'update'])->middleware('self');
    Route::get('/team/create', [\App\Http\Controllers\TeamController::class, 'index']);
    Route::get('/notification', [\App\Http\Controllers\NotificationController::class, 'index']);
    
    Route::post('/team/create/insert-team', [\App\Http\Controllers\TeamController::class, 'insert']);
});

