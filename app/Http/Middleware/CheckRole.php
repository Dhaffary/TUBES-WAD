<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user TIDAK SAMA dengan role yang diminta
        if (!auth()->check() || auth()->user()->role !== $role) {
            
            // Jika user mencoba akses halaman yang bukan haknya, 
            // arahkan ke dashboard dengan pesan error.
            return redirect('/dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk halaman tersebut.');
        }

        return $next($request);
    }
}