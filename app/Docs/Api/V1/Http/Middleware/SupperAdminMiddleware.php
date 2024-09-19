<?php

namespace App\Docs\Api\V1\Http\Middleware;

use App\Enums\Admin\AdminRoles;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SupperAdminMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth('admin')->check() && auth('admin')->user()->can('readAPIDoc')) {
                return $next($request);
        }

        return abort(404);
        
    }
}