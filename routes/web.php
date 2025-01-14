<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

// Home route
Route::get("/", function () {
    return view("home");
});

// Route to display the news form
Route::get('/news', [NewsController::class, 'index'])->name('news');

// Route to handle form submission
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
