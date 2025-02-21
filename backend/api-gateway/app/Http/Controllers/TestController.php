<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Firebase\JWT\JWT;

class TestController extends Controller
{
    public function testRedis()
    {
        Cache::put('test', 'Microservicios con Laravel y Redis', 600);
        $secretKey = env('JWT_SECRET');
        $payload = [
            'sub' => '02112017',
            'name' => 'User Test',
            'iat' => time(),
        ];

        $token = JWT::encode($payload, $secretKey, 'HS256');
        return response()->json(['message' => ['cache' => Cache::get('test'), 'token' => $token]]);
    }
}
