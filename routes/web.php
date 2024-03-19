<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/events/weekly', [EventController::class, 'showWeekly'])->name('events.weekly');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('events', EventController::class);
    Route::post('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');


});

