<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

class ValidateJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Obtener el token desde la cabecera Authorization
            $authHeader = $request->header('Authorization');
            
            if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                return response()->json(['error' => 'Token no proporcionado'], 401);
            }

            $token = $matches[1]; // Extraer el token JWT

            // Clave secreta (debe coincidir con la usada en el microservicio de autenticación)
            $secretKey = env('JWT_SECRET');

            // Decodificar el token
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

            // Adjuntar los datos del usuario decodificado a la solicitud
            $request->attributes->set('user', (array) $decoded);

        } catch (SignatureInvalidException $e) {
            return response()->json(['error' => 'Token inválido o expirado'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Token inválido o expirado'], 401);
        }

        return $next($request);
    }
}
