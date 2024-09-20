<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $guards = [
        'user' => 'user',
        'mahasiswa' => 'mahasiswa',
        'dosen' => 'dosen',
    ];

    public function login(Request $request)
    {
        $credentials = $request->only('username_email', 'password');

        $guards = [
            ['guard' => 'user', 'field' => 'username'],
            ['guard' => 'user', 'field' => 'email'],
            ['guard' => 'mahasiswa', 'field' => 'nim'],
            ['guard' => 'dosen', 'field' => 'nidn'],
        ];

        foreach ($guards as $g) {
            if (Auth::guard($g['guard'])->attempt([$g['field'] => $credentials['username_email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                $user = Auth::guard($g['guard'])->user();
                $role_id = Auth::guard($g['guard'])->user()->role_id;

                if (in_array($user->role->nama_role, ['Admin', 'Mahasiswa', 'Dosen'])) {
                    if ($role_id == 2) {
                        return redirect('/pengajuanjudul');
                    } elseif ($role_id == 3) {
                        return redirect('/dashboard-dosen');
                    } else {
                        return redirect('/dashboard');
                    }
                }
            }
        }

        return redirect('/login')->with(['warning' => 'Username/NIM/NIDN or Password is incorrect']);
    }

    public function logout()
    {
        foreach ($this->guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        return redirect('/login');
    }
}
