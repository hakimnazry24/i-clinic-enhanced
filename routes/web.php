<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;

// home route
Route::get('/', function () {
    return view('mainpage');
})->name('home');

Route::get('/medical-records/download/{filename}', [MedicalRecordController::class, 'download'])->name('medical_records.download');

// feedback route
Route::get('/feedback', [FeedbackController::class, 'index'])
     ->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])
     ->name('feedback.store');

// news route
Route::get('/news', [NewsController::class, 'index'])
     ->name('news');
Route::get('/news-form', [NewsController::class, 'news_form'])
     ->name('news-form');
Route::post('/news', [NewsController::class, 'store'])
     ->name('news.store');

// appointment routes
Route::get('/appointment', [AppointmentController::class, 'index'])
     ->name('appointment.index');

// alias the form page to the old name
Route::get('/appointment/create', [AppointmentController::class, 'create'])
     ->name('make-appointment');

// apply the strip_tags middleware here
Route::post('/appointment', [AppointmentController::class, 'store'])
     ->middleware('strip_tags')
     ->name('appointment.store');

// medical record route
Route::resource('medical_records', MedicalRecordController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [MedicalRecordController::class, 'index'])
         ->name('dashboard');
});