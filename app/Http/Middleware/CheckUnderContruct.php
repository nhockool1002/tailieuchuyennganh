<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;
use App\User;
use Auth;

class CheckUnderContruct
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
        $status = Setting::where('config_name', 'under_construct')->first();
        if ($status->config_setting == '0') {
            return $next($request);
        }
        else {
            if (Auth::check() && Auth::user()->role_id == '1') {
                return $next($request);
            }
            else {
                if(Auth::check()) {
                    Auth::logout();
                }
                return redirect(route('getLogin'))->with('failed_mesage', 'Website đang nâng cấp vui lòng quay lại sau');
            }
        }
        
    }
}
