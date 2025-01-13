<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

// Route to display announcements on the homepage
Route::get('/', [NewsController::class, 'index'])->name('news.index');

// Route to handle form submission for creating announcements
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
