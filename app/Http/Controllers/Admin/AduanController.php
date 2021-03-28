<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Aduan\Aduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Aduan\JenisAduan;
use App\Http\Controllers\Controller;

class AduanController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('created_at', 'desc')->get();
        $jenisAduan = JenisAduan::all();

        return view('page.admin.aduan.index', compact('jenisAduan', 'aduan'));
    }

    public function thisMonthIndex()
    {
        $aduan = Aduan::whereMonth('created_at', '=', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('page.admin.aduan.thisMonthIndex', compact('aduan'));
    }

    public function storeJenisAduan(Request $request)
    {
        $request->validate([
            'nama_aduan' => 'required|unique:jenis_aduans,nama_aduan',
            'keterangan' => 'required',
        ]);

        JenisAduan::create([
            'nama_aduan' => $request->nama_aduan,
            'slug' => Str::of($request->nama_aduan . ' ' . Str::random(6))->slug('-'),
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Jenis Aduan Berhasil Ditambahkan');
    }

    public function show(Aduan $aduan)
    {
        return view('page.admin.aduan.show.show', compact('aduan'));
    }

    public function timeline(Aduan $aduan)
    {
        // return $aduan->nonValid->foto;
        return view('page.admin.aduan.show.timeline', compact('aduan'));
    }

    public function updateJenisAduan(Request $request, JenisAduan $jenisAduan)
    {
        $request->validate([
            'nama_aduan' => 'required',
            'keterangan' => 'required',
        ]);

        JenisAduan::where('slug', $jenisAduan->slug)
            ->update([
                'nama_aduan' => $request->nama_aduan,
                'keterangan' => $request->keterangan,
            ]);

        return back()->with('success', 'Jenis Aduan Berhasil Diubah');
    }
}
