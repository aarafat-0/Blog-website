<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/home', function () {
    return view('home');
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/blog', PostController::class);
Auth::routes();
