<?php

namespace App\Http\Controllers\Warga;

use App\Models\Aduan\Aduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AduanController extends Controller
{
    public function index()
    {
        $aduan = Auth::user()->aduan()->latest()->get();

        return view('page.aduan.index', compact('aduan'));
    }

    public function create()
    {
        return view('page.aduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_masalah' => 'required|string|min:8',
            'foto' => 'required',
            'foto.*' => 'image',
            'jenis_aduan_id' => 'required',
            'detail_pengaduan' => 'required'
        ]);

        $aduan = Auth::user()->aduan()->create([
            'judul_masalah' => $request->judul_masalah,
            'slug' => Str::of($request->judul_masalah . ' ' . Str::random(6))->slug('-'),
            'jenis_aduan_id' => $request->jenis_aduan_id,
            'detail_pengaduan' => $request->detail_pengaduan
        ]);

        foreach ($request->file('foto') as $image) {
            $nameFile = $aduan->id . '_' . time() . '.' . $image->extension();
            Storage::putFileAs(
                'public/aduan',
                $image,
                $nameFile
            );

            $aduan->foto()->create([
                'foto' => $nameFile
            ]);
        }

        return redirect()->route('aduan.index')->with('success', 'Aduan Berhasil Dikirim');
    }

    public function show(Aduan $aduan)
    {
        return view('page.aduan.show', compact('aduan'));
    }

    public function comment(Aduan $aduan, Request $request)
    {
        $request->validate([
            'comment' => 'required|min:8'
        ]);

        $aduan->update([
            'progress' => $aduan->progress + 1
        ]);

        $aduan->valid->commentWarga()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Komentar anda sudah disimpan, terima kasih!');
    }
}
