<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Controller;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'manager') {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'not authorized',
            ], 401);
        }
        return $next($request);
    }
}
