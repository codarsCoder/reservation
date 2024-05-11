<?php

use App\Http\Controllers\web\EventController;
use App\Http\Controllers\web\RegistrationController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\UseController;



Route::middleware('auth')->group(function () {

    Route::get('/', [EventController::class, 'index'])->name('home');

    Route::get('/create-event', function () {
        return view('create_event');
    })->name('create.event.page');

    Route::post('/create-event', [EventController::class, 'create_event'])->name('create.event');

    Route::get('/edit-event/{id}', [EventController::class, 'edit_event'])->name('edit.event.page');

    Route::post('/update-event/{id}', [EventController::class, 'update_event'])->name('update.event');

    Route::get('/delete-event/{id}', [EventController::class, 'delete_event'])->name('delete.event');

    Route::get('/my-events', [EventController::class, 'my_events'])->name('my.events');

    Route::get('/all-events', [EventController::class, 'all_events'])->name('events.page');

    Route::get('/join-event/{id}', [RegistrationController::class, 'join_event'])->name('join.event');

    Route::get('/unjoin-event/{id}', [RegistrationController::class, 'unjoin_event'])->name('unjoin.event');

});


Route::get('event-detail/{id}', [EventController::class, 'event_detail']);

// Auth pages
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('login');
})->name('login.page');

Route::get('/register', function () {
    return view('register');
})->name('register.page');

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

