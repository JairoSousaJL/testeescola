<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ApiProtected extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException){
                return response()->json(['status' => 'Token esta INVALIDO!']);
            }else if ($exception instanceof TokenExpiredException){
                return response()->json(['status' => 'Token esta EXPIRADO!']);
            }else{
                return response()->json(['status' => 'Token de autorizacaoo nao encontrado!']);
            }
        }
        return $next($request);
    }
}
