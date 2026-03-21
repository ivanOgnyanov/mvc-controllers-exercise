<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/articles', function () {
    return view('pages.articles');
})->name('articles.index');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
