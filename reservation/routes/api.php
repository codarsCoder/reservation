<?php

use App\Http\Controllers\api\ApiEventController;
use App\Http\Controllers\api\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:api')->group(function () {

    Route::post('user', function (Request $request) {
        return $request->user();
    });

    Route::post('create-event', [ApiEventController::class, 'create_event']);
    Route::put('update-event', [ApiEventController::class, 'update_event']);
    Route::delete('delete-event', [ApiEventController::class, 'delete_event']);
    Route::get('my-events', [ApiEventController::class, 'my_events']);
    Route::post('join-event', [ApiEventController::class, 'join_event']);
    Route::post('unjoin-event', [ApiEventController::class, 'unjoin_event']);

});

Route::get('event-detail/{id}', [ApiEventController::class, 'event_detail']);

Route::post('login', [ApiUserController::class, 'login']);
Route::post('register', [ApiUserController::class, 'register']);
Route::get('all-events', [ApiEventController::class, 'all_events']);

