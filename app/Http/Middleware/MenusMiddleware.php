<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $users = Auth::guard('admin')->user();
        if(!$users){
            $users = Auth::guard('merchant')->user();
            if(!$users){
                $users = Auth::guard('store')->user();
                if(!$users){
                    $guard = false;
                } else {
                    $guard = 'store';
                }
            } else {
                $guard = 'merchant';
            }
        } else {
            $guard = 'web';
        }

        if($guard){
            $menus = Permissions::with('child_hasMany')
                ->where('is_menus', 1)
                ->where('pid', 0)
                ->where('guard_name', $guard)
                ->where('show', 1)
                ->get();;
        } else {
            $menus = [];
        }
        view()->share('menus', $menus);
        view()->share('users', $users);

        return $next($request);
    }
}
