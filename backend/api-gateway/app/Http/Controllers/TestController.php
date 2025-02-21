<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function testRedis()
    {
        Cache::put('test', 'Microservicios con Laravel y Redis', 600);
        return response()->json(['message' => Cache::get('test')]);
    }
}
