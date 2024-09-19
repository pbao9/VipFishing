<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->routeIs('api.*')){
                return response()->json([
                    'status' => 401,
                    'message' => __('Xác thực không thành công.')
                ], 401);
            }
            return route('login');
        }
    }

}
