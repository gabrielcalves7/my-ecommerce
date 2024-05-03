<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $a = 1;
        if(Auth::id() != null){
            $id = Auth::id();
            $v_User = User::where($id)->get('user_type_id');
        }
        return $request->expectsJson() ? null : route('login');
    }
}
