<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePemerintah
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session('auth_role') !== 'pemerintah') {
            return redirect()->route('pemerintah.login')
                ->withErrors(['username' => 'Silakan login sebagai pemerintah terlebih dahulu.']);
        }

        return $next($request);
    }
}
