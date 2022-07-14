<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoteListController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VoyagerUserController;
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

Route::middleware(['auth'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/voteList/index/{id}', [VoteListController::class,'voteListIndex'])->whereNumber('id');
    Route::get('/voteList/create', [VoteListController::class,'voteListCreate'])->name('voteListCreate');
    Route::post('/voteList/store', [VoteListController::class,'voteListStore'])->name('voteListStore');
    Route::post('/vote/store', [VoteController::class,'voteStore'])->name('voteStore');
    Route::get('/voteListResult/index/{id}', [VoteListController::class,'voteListResult'])->whereNumber('id');
    Route::get('/voteListResult/create/{id}', [VoteListController::class,'voteListResultCreate'])->whereNumber('id')->name('voteListResultCreate');
    //Route::post('/voteListResult/store', [VoteListController::class,'voteListResultStore'])->name('voteListResultStore');
    Route::get('/voteResultList', [VoteListController::class,'voteResultList'])->name('voteResultList');
    Route::get('/user/anonymous/create', [VoyagerUserController::class,'anonymousCreate'])->name('anonymousCreate');
    Route::post('/user/anonymous/store', [VoyagerUserController::class,'anonymousStore'])->name('anonymousStore');
    //Route::get('/anonymous/export', [VoyagerUserController::class, 'export'])->name('anonymousExport');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


