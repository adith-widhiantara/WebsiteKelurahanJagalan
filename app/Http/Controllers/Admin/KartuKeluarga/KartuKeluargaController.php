<?php

namespace App\Http\Controllers\Admin\KartuKeluarga;

use Illuminate\Http\Request;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use App\Http\Requests\KartuKeluargaRequest;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        $kartuKeluarga = KartuKeluarga::all();
        return view('page.admin.keluarga.kartu.index', compact('kartuKeluarga'));
    }

    public function create()
    {
        return view('page.admin.keluarga.kartu.create');
    }

    public function store(KartuKeluargaRequest $request)
    {
        KartuKeluarga::create($request->validated());

        return redirect()
            ->route('admin.kartukeluarga.index')
            ->with('success', 'Kartu Keluarga Berhasil Ditambahkan');
    }

    public function show(KartuKeluarga $kartuKeluarga)
    {
        return view('page.admin.keluarga.kartu.show', compact('kartuKeluarga'));
    }

    public function update(Request $request, KartuKeluarga $kartuKeluarga)
    {
        $request->validate([
            'alamat' => 'required|min:8|string',
            'kode_pos' => 'required|integer',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'telepon_rumah' => 'required|string',
        ]);

        $kartuKeluarga->update([
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'telepon_rumah' => $request->telepon_rumah,
        ]);

        return back()->with('success', 'Data kartu keluarga berhasil diperbarui!');
    }
}
