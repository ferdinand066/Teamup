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
    return redirect()->route('team');
});

Auth::routes();

Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::post('/profile/{id}/update', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->middleware('self')->name('profile.update');
    
    Route::prefix('/team')->group(function () {
        Route::get('/team-leader/{id}', [\App\Http\Controllers\TeamController::class, 'search_leader'])->name('team.search.leader');

        Route::prefix('/create')->group(function () {
            Route::get('/', [\App\Http\Controllers\TeamController::class, 'create'])->name('team.create');
            Route::post('/insert-team', [\App\Http\Controllers\TeamController::class, 'insert'])->name('team.insert');
        });

        Route::prefix('/{id}')->group(function () {
            Route::get('/edit', [\App\Http\Controllers\TeamController::class, 'edit'])->name('team.edit')->middleware('edit-team');
            Route::post('/edit', [\App\Http\Controllers\TeamController::class, 'edit_data'])->name('team.edit.data');
            Route::post('/insert', [\App\Http\Controllers\TeamController::class, 'make_detail'])->middleware('join-team')
                ->name('team.insert.detail');
            Route::post('/close', [\App\Http\Controllers\TeamController::class, 'close'])
                ->name('team.close');  

        });

        Route::prefix('/detail')->group(function () {
            Route::post('/remove-member', [\App\Http\Controllers\TeamController::class, 'remove_member'])->name('member.remove');
            Route::post('/accept-member', [\App\Http\Controllers\TeamController::class, 'accept_member'])->name('member.accept');  
        });

        Route::prefix('/forum')->group(function () {
            Route::post('/add', [\App\Http\Controllers\ForumController::class, 'add'])->name('forum.add');
            Route::post('/update', [\App\Http\Controllers\ForumController::class, 'update'])->name('forum.update');
            Route::post('/delete', [\App\Http\Controllers\ForumController::class, 'delete'])->name('forum.delete');
        });
    });

    Route::get('/project', [\App\Http\Controllers\TeamController::class, 'project'])->name('project');

    Route::get('/notification', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notification');
});

Route::prefix('/team')->group(function () {
    Route::get('/', [\App\Http\Controllers\TeamController::class, 'index'])->name('team');
    Route::get('/view/{id}', [\App\Http\Controllers\TeamController::class, 'details'])->name('team.detail'); 
});

Route::get('/notification/count', [\App\Http\Controllers\NotificationController::class, 'count'])->name('notification.count');