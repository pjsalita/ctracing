<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DestinationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/contacts');
    });

    Route::get('contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contacts', [ContactController::class, 'store'])->name('contact.store');
    // Route::get('contacts/create', [ContactController::class, 'create'])->name('contact.create');
    // Route::get('contacts/{contact}', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('contacts/{contact}', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contact.delete');

    Route::get('rooms', [RoomController::class, 'index'])->name('room.index');
    Route::post('rooms', [RoomController::class, 'store'])->name('room.store');
    // Route::get('rooms/create', [RoomController::class, 'create'])->name('room.create');
    Route::get('rooms/{room}', [RoomController::class, 'edit'])->name('room.edit');
    Route::put('rooms/{room}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('room.delete');

    Route::get('destinations', [DestinationController::class, 'index'])->name('destination.index');
    Route::post('destinations', [DestinationController::class, 'store'])->name('destination.store');
    // Route::get('destinations/create', [DestinationController::class, 'create'])->name('destination.create');
    // Route::get('destinations/{destination}', [DestinationController::class, 'edit'])->name('destination.edit');
    Route::put('destinations/{destination}', [DestinationController::class, 'update'])->name('destination.update');
    Route::delete('destinations/{destination}', [DestinationController::class, 'destroy'])->name('destination.delete');
});

require __DIR__.'/auth.php';
