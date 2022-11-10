<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dosen
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
        if(!Auth::guard('dosen')->check()){
            $notification = array(
                'message' => 'silahkan login terlebih dahulu !',
                'alert-type' => 'error',
            );
            return redirect()->route('dosen.login.form')->with($notification);
        }
        return $next($request);
    }
}
