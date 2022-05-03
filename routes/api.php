<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

function notFound () {
    return response()->json([ 'status' => 404, 'message' => 'Not found.' ]);
};

Route::apiResource('users', UserController::class)->missing('notFound');
Route::apiResource('destinations', DestinationController::class)->missing('notFound');
