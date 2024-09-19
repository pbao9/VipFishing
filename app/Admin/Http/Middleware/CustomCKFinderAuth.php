<?php

namespace App\Admin\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class CustomCKFinderAuth extends Middleware
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
        $configCkfinder = [
            'ckfinder.authentication' => function(){return true;}
        ];
        // $auth = auth()->guard('admin')->user();

        // if(!in_array($auth->role, ['admin', 'dev'])){

        //     $resourceTypes = config('ckfinder.resourceTypes');

        //     unset($resourceTypes[3]);

        //     array_merge($configCkfinder, [
        //         'ckfinder.resourceTypes' => $resourceTypes,
        //         'ckfinder.backends.default.baseUrl' => env('APP_URL', '').'/public/uploads/users/'.$auth->id.'/',
        //         'ckfinder.backends.default.root' => public_path('/uploads/users/'.$auth->id.'/'),
        //     ]);
        // }

        config($configCkfinder);

        return $next($request);
    }
}
