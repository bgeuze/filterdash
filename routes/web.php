<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LikeController;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/edit', 'App\Http\Controllers\UserController@editProfile')->name('profile.edit')->middleware('auth');
Route::post('/profile/update', 'App\Http\Controllers\UserController@updateProfile')->name('profile.update')->middleware('auth');

// Filters Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/filters', [FilterController::class, 'index'])->name('filters.index');
//    Route::get('/filters/{filter}', [FilterController::class, 'show'])->name('filters.show')->middleware('can:view,filter');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('filters', FilterController::class, ['except' => ['index']]);
});

Route::post('/filters/{filter}/update-status', 'App\Http\Controllers\FilterController@updateStatus')->name('filters.update-status')->middleware('auth');
Route::post('/filters/{filter}/like', [LikeController::class, 'likeFilter'])->name('filters.like');
Route::get('/filters/{filter}', 'App\Http\Controllers\FilterController@show')->name('filters.show');
Route::post('/filters/{filter}/comments', 'App\Http\Controllers\CommentController@store')->name('filters.comments.store');
