<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/notifications',[NotificationController::class,'sendNotification']);

Route::get('/test-redis',function(){
    try{
        $result = Redis::publish('notifications',json_encode([
            'id'=>1,
            'user_id'=>1,
            'message'=>'This is a test message from laravel'
        ]));
        Log::info('Redis Publish Result: '.$result);

        return 'Message Published!!!';
    }catch(Exception $e){
        Log::error('Redis error: '.$e->getMessage());
        return 'Redis Failed';
    }
  
});
