<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




use App\Http\Controllers\EventController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\ParticipantController;
Route::resource('/events', EventController::class);
Route::resource('/speakers', SpeakerController::class);
Route::resource('/participants', ParticipantController::class);


Route::get('/events/{id}/pdf', [EventController::class, 'generatePdf'])->name('events.pdf');
Route::get('/events/{id}/export', [EventController::class, 'exportParticipants'])->name('events.export');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

