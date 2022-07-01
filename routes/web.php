<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserInfomationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoteListController;

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
//Route::get('/test', [UserInfomationController::class, 'indexall']);



Route::middleware(['auth'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/voteList/index/{id}', [VoteListController::class,'voteListIndex']);
    Route::get('/voteList/create', [VoteListController::class,'voteListCreate'])->name('voteListCreate');
    Route::post('/voteList/store', [VoteListController::class,'voteListStore'])->name('voteListStore');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


