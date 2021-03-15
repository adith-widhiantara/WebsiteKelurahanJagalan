<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nomor_ktp', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('landing');
        }

        $checkNomorKTP = User::where('nomor_ktp', $request->nomor_ktp)->first();
        if (isset($checkNomorKTP)) {
            return back()->withErrors([
                'password' => 'Password tidak benar!'
            ]);
        }

        return back()->withErrors([
            'nomor_ktp' => 'Nomor KTP tidak terdaftar!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
