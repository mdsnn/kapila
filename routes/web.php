<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/idea', [IdeaController::class, 'store'])->name('idea.create');
Route::get('/idea/{idea}', [IdeaController::class, 'show'])->name('idea.show');
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit')->middleware('auth');
Route::put('/idea/{idea}', [IdeaController::class, 'update'])->name('idea.update')->middleware('auth');
Route::delete('/idea/{id}', [IdeaController::class, 'destroy'])->name('idea.destroy')->middleware('auth');

Route::post('/idea/{idea}/comments', [CommentController::class, 'store'])->name('idea.comments.store')->middleware('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('registration');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('signin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::post('/users/{users}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('/users/{users}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');
Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');



