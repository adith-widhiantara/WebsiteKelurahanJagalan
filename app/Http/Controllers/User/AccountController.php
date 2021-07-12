<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nomor_ktp', 'password');

        $checkPendataan = User::query()
            ->where('nomor_ktp', $request->nomor_ktp)
            ->with('kematian')
            ->with('keluar')
            ->first();

        if (isset($checkPendataan)) {
            if ($checkPendataan->kematian()->exists()) {
                return back()->withErrors([
                    'nomor_ktp' => 'Pengguna akun ini telah meninggal!',
                ]);
            }
            if ($checkPendataan->keluar()->exists()) {
                return back()->withErrors([
                    'nomor_ktp' => 'Pengguna akun ini telah pindah keluar!',
                ]);
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (isset(Auth::user()->forgetPassword)) {
                Auth::user()->forgetPassword()->delete();
            }

            if (empty(Auth::user()->getRoleNames()[0])) {
                return redirect()->route('landing')->with('login', 'Selamat Datang!');
            } else {
                if (isset(Auth::user()->pengurus)) {
                    Auth::user()->pengurus()
                        ->update([
                            'terakhir_masuk_sistem' => now(),
                        ]);
                }

                return redirect()->route('admin.index')->with('success', 'Selamat Datang!');
            }
        }

        if (isset($checkPendataan)) {
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

        return redirect()->route('landing')->with('success', 'Sampai jumpa!');
    }
}
