<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsController;

// home route
Route::get('/', function () {
    return view('home');
})->name("home");

// feedback route
Route::get("/feedback", [FeedbackController::class, "index"])->name("feedback.index");
Route::post("/feedback", [FeedbackController::class, "store"])->name("feedback.store");

// news route
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news-form', [NewsController::class, 'news_form'])->name('news-form');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('patient.dashboard');
    })->name('dashboard');
});

