<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next, ...$allowedRoles)
    {
        if (!auth()->check()) {
            // Pengguna tidak terautentikasi, tangani sesuai kebutuhan
            return redirect('/login');
        }

        $userRole = auth()->user()->role->nama_role;
        // dd($userRole);
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // Pengguna tidak memiliki peran yang diperlukan, tangani sesuai kebutuhan
        return redirect('/');
    }
}
