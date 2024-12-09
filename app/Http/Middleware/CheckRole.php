<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login terlebih dahulu');
        }

        // Cek apakah pengguna memiliki role yang sesuai
        if (Auth::user()->role_id !== $role) {
            return redirect()->back()->withErrors('Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
