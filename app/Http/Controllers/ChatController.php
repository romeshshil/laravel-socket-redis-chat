<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use Auth;

class ChatController extends Controller
{
    public function postMessage(Request $request)
    {
        $response = ['message' => $request->message, 'user' => Auth::user()->name];
        $redis = Redis::connection();
        $redis->publish('message', json_encode($response));
        return response()->json($response, 200);
    }
}
