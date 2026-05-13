<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'owner') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Owner.');
        }

        return $next($request);
    }
}
