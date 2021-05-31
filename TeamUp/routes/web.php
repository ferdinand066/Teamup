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
    Route::post('/profile/{id}/update', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->middleware('self')->name('profile.update');
    Route::get('/team/create', [\App\Http\Controllers\TeamController::class, 'create'])->name('team.create');
    
    Route::get('/team/team-leader/{id}', [\App\Http\Controllers\TeamController::class, 'search_leader'])->name('search.leader');
    Route::post('/team/create/insert-team', [\App\Http\Controllers\TeamController::class, 'insert'])->name('team.insert');
    Route::post('/team/{id}/insert', [\App\Http\Controllers\TeamController::class, 'make_detail'])->middleware('join-team')
        ->name('team.insert.detail');

    Route::get('/notification', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notification');
});

Route::get('/team', [\App\Http\Controllers\TeamController::class, 'index'])->name('view.team');
Route::get('/team/view/{id}', [\App\Http\Controllers\TeamController::class, 'details'])->name('team.detail');