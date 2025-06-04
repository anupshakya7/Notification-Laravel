<?php

use App\Http\Controllers\NotificationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Create new Notification
Route::post('/notifications',[NotificationController::class,'sendNotification']);

//Update Notification Status
Route::put('/notifications/{id}/status',[NotificationController::class,'updateNotificationStatus']);

//Recent Notifications
Route::get('/notifications/recent',[NotificationController::class,'recent']);

//Summary Notifications
Route::get('/notifications/summary',[NotificationController::class,'summary']);