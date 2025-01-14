<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainpage');
});

Route::get('/make-appointment', function () {
    return view('appointment');
})->name('make-appointment');

Route::post("/make-appointment", [AppointmentController::class, "store"])->name("appointment.store");

Route::get('appointment', [AppointmentController::class, 'index']);
Route::resource('appointment', AppointmentController::class);

