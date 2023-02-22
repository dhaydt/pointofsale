<?php

namespace App\Http\Middleware;

use App\Models\LoginLogs;
use Closure;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class Autentikasi
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $loginLogs = LoginLogs::where('user_id', $request->session()->get('user_id'))
            ->where('token', $request->session()->get('token'))
            ->where('is_active', 1)->first();

        if ($loginLogs) {
            return $next($request);
        } else {
            Toastr()->error('Not Authorized User!');

            return redirect()->route('login');
        }
    }
}
