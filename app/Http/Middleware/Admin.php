<?php

namespace App\Http\Middleware;

use Auth;
use Route;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        $myData = Auth::guard('admin')->user();
        if ($myData == "") {
            $fromRoute = Route::currentRouteName();
            return redirect()->route('admin.loginPage', ['r' => $fromRoute])->withErrors(['Anda harus login dulu sebelum melanjutkan']);
        }
        return $next($request);
    }
}
