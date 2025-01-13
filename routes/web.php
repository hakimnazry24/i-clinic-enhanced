<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get("/feedback", [FeedbackController::class, "create"])->name("feedback.create");
Route::post("/feedback", [FeedbackController::class, "store"])->name("feedback.store");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('patient.dashboard');
    })->name('dashboard');
});
