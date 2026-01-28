<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Filament\Facades\Filament;
use Symfony\Component\HttpFoundation\Response;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Support\Facades\Auth;



class RedirectIfPegawai
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->is_admin) {
            return $next($request);
        }
        return redirect('/pegawai');
    }
}
