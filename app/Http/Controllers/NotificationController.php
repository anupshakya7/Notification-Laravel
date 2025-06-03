<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function sendNotification(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'user_id'=>'required|integer|exists:users,id',
                'message'=>'required|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'errors'=>$validator->errors()
                ],422);
            }

            $count = Notification::where('user_id',$request->user_id)->where('created_at','>=',now()->subHour())->count();

            if($count >= 10){
                return response()->json(['error'=>'Rate limit exceeded.'],429);
            }

            $notification = Notification::create([
                'user_id'=>$request->user_id,
                'message'=>$request->message,
            ]);
            
            Redis::publish('notifications',json_encode([
                'id'=>$notification->id,
                'user_id'=>$notification->user_id,
                'message'=>$notification->message,
            ]));

            Log::info('Successfully queued Notification!!!');
            return response()->json(['message'=>'Notification Queued.']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error'=>'Something went wrong']);
        }
        
    }
}
