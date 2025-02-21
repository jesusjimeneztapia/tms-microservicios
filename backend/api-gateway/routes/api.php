<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Middleware\ValidateJwtMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', [TestController::class, 'testRedis']);

Route::middleware([ValidateJwtMiddleware::class])->group(function () {
    // Redirigir solicitudes al microservicio de "tasks"
    Route::get('/tasks', function (Request $request) {
        $user = $request->attributes->get('user'); // Obtener datos del usuario desde el token

        // // Reenviar la solicitud al microservicio de "tasks"
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $request->header('Authorization')
        // ])->get('http://tasks-service/api/tasks');

        // return $response->json();
        return response()->json($user);
    });
});