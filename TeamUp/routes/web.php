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
    return redirect('/team');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::post('/profile/{id}/update', [\App\Http\Controllers\ProfileController::class, 'update'])->middleware('self');
    Route::get('/team/create', [\App\Http\Controllers\TeamController::class, 'insert']);
    Route::get('/notification', [\App\Http\Controllers\NotificationController::class, 'index']);
    Route::get('/team/team-leader/{id}', [\App\Http\Controllers\TeamController::class, 'search_leader']);
    Route::post('/team/create/insert-team', [\App\Http\Controllers\TeamController::class, 'make']);
Route::post('/team/{id}/insert', [\App\Http\Controllers\TeamController::class, 'make_detail'])->middleware('join-team');
});

Route::get('/team', [\App\Http\Controllers\TeamController::class, 'index']);
Route::get('/team/view/{id}', [\App\Http\Controllers\TeamController::class, 'details']);