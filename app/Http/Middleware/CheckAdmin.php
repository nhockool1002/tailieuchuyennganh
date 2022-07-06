<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->role_id == '1') {
                return $next($request);
            }
        }
        $errors = new MessageBag(['errorlogin' => 'Không đủ quyền hạn để truy cập']);
        return redirect(route('getLogin'))->withErrors($errors);
    }
}
