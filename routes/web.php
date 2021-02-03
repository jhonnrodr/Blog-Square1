<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Cms\IndexController;

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::resource('posts', PostController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
