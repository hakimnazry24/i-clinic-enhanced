<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

// Route to display the form (news.blade.php)
Route::get('/news', function () {
    return view('news');
})->name('news');

// Route to handle form submission
Route::post('/submit-form', [NewsController::class, 'submitForm'])->name('submitForm');
