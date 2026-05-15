<?php

use App\Models\User;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('posts', PostController::class)->middleware('auth');
Route::post('/users/follow', [FollowController::class, 'follow'])->name('user.follow')->middleware('auth');
Route::delete('/users/follow', [FollowController::class, 'unfollow'])->name('user.unfollow')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::post('/like', [LikeController::class, 'toggle'])->name('posts.like')->middleware('auth');
Route::get('/', function () {return redirect('/posts');});
