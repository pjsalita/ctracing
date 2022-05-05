<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect('/users');
});

Route::get('users', [UserController::class, 'index'])->name('user.index');
Route::post('users', [UserController::class, 'store'])->name('user.store');
Route::get('users/create', [UserController::class, 'create'])->name('user.create');
Route::get('users/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('user.delete');

Route::get('rooms', [RoomController::class, 'index'])->name('room.index');
Route::post('rooms', [RoomController::class, 'store'])->name('room.store');
Route::get('rooms/create', [RoomController::class, 'create'])->name('room.create');
Route::get('rooms/{room}', [RoomController::class, 'edit'])->name('room.edit');
Route::put('rooms/{room}', [RoomController::class, 'update'])->name('room.update');
Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('room.delete');

Route::get('destinations', [DestinationController::class, 'index'])->name('destination.index');
Route::post('destinations', [DestinationController::class, 'store'])->name('destination.store');
Route::get('destinations/create', [DestinationController::class, 'create'])->name('destination.create');
Route::get('destinations/{destination}', [DestinationController::class, 'edit'])->name('destination.edit');
Route::put('destinations/{destination}', [DestinationController::class, 'update'])->name('destination.update');
Route::delete('destinations/{destination}', [DestinationController::class, 'destroy'])->name('destination.delete');
