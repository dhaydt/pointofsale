<?php

namespace App\Http\Middleware;

use App\CPU\Helpers;
use App\Models\LoginLogs;
use Closure;
use Illuminate\Http\Request;

class ApiAuth
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
        $token = explode(' ', $request->header('authorization'));
        if(count($token) == 1){
            return response()->json(Helpers::responseApi('fail', 'Not Authorized User'));
        }
        $loginLogs = LoginLogs::where('token', $token[1])
            ->where('is_active', 1)->first();

        if ($loginLogs) {
            return $next($request);
        } else {
            return response()->json(Helpers::responseApi('fail', 'Token Expired'));
        }
    }
}
