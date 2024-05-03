<?php

namespace App\Http\Middleware;

use App\Models\UserType;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::id()){
            return redirect()->route('login');
        }

        if (!UserType::isAdmin()) {
            throw new HttpException(403, 'not_authorized');
        }

        return $next($request);
    }
}
