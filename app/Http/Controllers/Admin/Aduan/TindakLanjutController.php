<?php

namespace App\Http\Controllers\Admin\Aduan;

use App\Http\Controllers\Controller;
use App\Models\Aduan\Aduan;
use App\Models\Aduan\Valid\ValidAduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $aduan = ValidAduan::doesntHave('commentKepala')
            ->doesntHave('commentWarga')
            ->get();
        return view('page.admin.aduan.tindaklanjut.index', compact('aduan'));
    }

    public function store(Aduan $aduan, Request $request)
    {
        $aduan->update([
            'progress' => 2
        ]);

        $aduan->valid->commentRW()->update([
            'status' => 1,
            'user_id' => Auth::id(),
            'applied_at' => now()
        ]);

        return back()->with('success', 'Selamat Menindaklanjut Aduan Ini');
    }

    public function put(Request $request, Aduan $aduan)
    {
        if ($aduan->valid->commentRW->user_id != Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menyelesaikan aduan!');
        }

        $request->validate([
            'comment' => 'required|string|min:8',
            'foto' => 'required',
            'foto.*' => 'image'
        ]);

        $aduan->update([
            'progress' => 3,
        ]);

        $aduan->valid->commentRW()->update([
            'status' => 2,
            'comment' => $request->comment,
        ]);

        foreach ($request->file('foto') as $image) {
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move('image/aduan/valid', $name);

            $aduan->valid->foto()->create([
                'foto' => $name,
                'user_id' => Auth::id()
            ]);
        }

        return back()->with('success', 'Bukti penindalanjutan aduan berhasil diunggah');
    }

    public function commentKepalaKelurahan(Request $request, Aduan $aduan)
    {
        $request->validate([
            'comment' => 'required|min:8|string',
        ]);

        $aduan->update([
            'progress' => $aduan->progress + 1
        ]);

        $aduan->valid->commentKepala()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Komentar anda berhasil ditambahkan!');
    }
}
