<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Cms\PostController;

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::resource('posts', PostController::class);

require __DIR__.'/auth.php';
