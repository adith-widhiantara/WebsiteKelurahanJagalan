<?php

namespace App\Http\Controllers\Admin\Aduan;

use App\Models\Aduan\Aduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Aduan\Valid\ValidAduan;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $aduan = ValidAduan::query()
            ->doesntHave('commentKepala')
            ->doesntHave('commentWarga')
            ->orderBy('created_at', 'desc')
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
            return back()
                ->with('error', 'Anda tidak bisa menyelesaikan aduan!');
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
            $nameFile = $aduan->id . '_' . time() . '.' . $image->extension();
            Storage::putFileAs(
                'public/aduan/valid',
                $image,
                $nameFile
            );

            $aduan->valid->foto()->create([
                'foto' => $nameFile,
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
