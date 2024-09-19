<?php

namespace App\Api\V1\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('X-TOKEN-ACCESS') === config('custom_api.X-TOKEN-ACCESS')){
            return $next($request);
        }
        return response()->json([
            'status' => 403,
            'message' => __('Bạn không có quyền truy cập.')
        ], 403);
    }
}
