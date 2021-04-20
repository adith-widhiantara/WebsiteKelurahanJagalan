<?php

namespace App\Http\Controllers\Admin\Surat;

use App\Models\Surat\Jenis;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Models\Surat\Administrasi;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenisSurat = Jenis::all();

        return view('page.admin.surat.jenis.index', compact('jenisSurat'));
    }

    public function list($jenisSurat)
    {
        $daftarSurat = Administrasi::with('jenis')
            ->where('surat_jenis_id', $jenisSurat)
            ->latest()
            ->get();
        $jenisSurat = Jenis::findOrFail($jenisSurat);

        return view('page.admin.surat.jenis.list', compact('jenisSurat', 'daftarSurat'));
    }

    public function show(Jenis $jenisSurat)
    {
        return view('page.admin.surat.jenis.show', compact('jenisSurat'));
    }

    public function update(Request $request, Jenis $jenisSurat)
    {
        $request->validate([
            'format_nomor_surat' => ['required', 'min:8'],
            'keterangan' => ['required', 'min:8'],
        ]);

        $jenisSurat->update([
            'format_nomor_surat' => $request->format_nomor_surat,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.jenis.list', $jenisSurat->id)->with('success', 'Jenis surat berhasil diperbarui');
    }
}
