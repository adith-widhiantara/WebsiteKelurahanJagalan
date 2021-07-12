<?php

namespace App\Http\Controllers\Warga\Surat;

use App\Models\User;
use App\Models\Surat\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Surat\Administrasi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $dataSurat = Administrasi::query()
            ->with('jenis')
            ->with('usaha')
            ->with('bedaNama')
            ->with('penghasilan')
            ->with('hargaTanah')
            ->with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('page.warga.surat.index', compact('dataSurat'));
    }

    public function showFile(Administrasi $administrasi)
    {
        if ($administrasi->bedaNama) {
            $fileName = $administrasi->bedaNama->file_surat;
            $file = Storage::path('public/surat/syarat/bedaNama/' . $fileName);

            return response()->file($file);
        } elseif ($administrasi->penghasilan) {
            $fileName = $administrasi->penghasilan->bukti_penghasilan;
            $file = Storage::path('public/surat/syarat/penghasilan/' . $fileName);

            return response()->file($file);
        } elseif ($administrasi->hargaTanah) {
            $fileName = $administrasi->hargaTanah->fileSertifikatTanah;
            $file = Storage::path('public/surat/syarat/hargaTanah/' . $fileName);

            return response()->file($file);
        }

        return redirect()->back();
    }

    public function create(Jenis $jenisSurat)
    {
        if ($jenisSurat->slug == 'surat_keterangan_usaha') {
            return view('page.warga.surat.create.suratKeteranganUsaha', compact('jenisSurat'));
        } elseif ($jenisSurat->slug == 'surat_keterangan_tidak_mampu') {
            return view('page.warga.surat.create.suratKeteranganTidakMampu', compact('jenisSurat'));
        } elseif ($jenisSurat->slug == 'surat_keterangan_belum_pernah_menikah') {
            return view('page.warga.surat.create.suratKeteranganBelumPernahMenikah', compact('jenisSurat'));
        } elseif ($jenisSurat->slug == 'surat_keterangan_beda_nama') {
            return view('page.warga.surat.create.suratBedaNama', compact('jenisSurat'));
        } elseif ($jenisSurat->slug == 'surat_keterangan_penghasilan') {
            return view('page.warga.surat.create.suratKeteranganPenghasilan', compact('jenisSurat'));
        } elseif ($jenisSurat->slug == 'surat_keterangan_harga_tanah') {
            return view('page.warga.surat.create.suratKeteranganHargaTanah', compact('jenisSurat'));
        }

        return redirect()
            ->route('warga.surat.index');
    }

    public function store(Request $request, Jenis $jenisSurat)
    {
        if ($jenisSurat->slug == 'surat_keterangan_usaha') {
            //
            $request->validate([
                'sejak' => ['required', 'integer'],
                'keperluan' => ['required'],
                'pesan' => ['required'],
                'keterangan' => ['nullable'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => Auth::id(),
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'keterangan' => $request->keterangan,
            ]);

            $surat->usaha()->create([
                'sejak' => $request->sejak
            ]);
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_tidak_mampu') {
            //
            $request->validate([
                'keperluan' => ['required'],
                'pesan' => ['required'],
                'keterangan' => ['nullable'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => Auth::id(),
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'keterangan' => $request->keterangan,
            ]);
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_belum_pernah_menikah') {
            //
            $request->validate([
                'keperluan' => ['required'],
                'pesan' => ['required'],
                'keterangan' => ['nullable'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => Auth::id(),
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'keterangan' => $request->keterangan,
            ]);
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_beda_nama') {
            //
            $request->validate([
                'jenis_surat' => ['required'],
                'nama_yang_tertera' => ['required'],
                'nomor_surat_tersebut' => ['required'],
                'file_surat' => ['required', 'file', 'max:7168'],

                'keperluan' => ['required', 'min:8'],
                'pesan' => ['required', 'min:8'],
                'keterangan' => ['nullable'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => Auth::id(),
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'keterangan' => $request->keterangan,
            ]);

            $surat->bedaNama()->create([
                'jenis_surat' => $request->jenis_surat,
                'nama_yang_tertera' => $request->nama_yang_tertera,
                'nomor_surat_tersebut' => $request->nomor_surat_tersebut,
                'file_surat' => $request->jenis_surat . '_' . $request->nama_yang_tertera . '_' . time() . '.' . $request->file('file_surat')->extension(),
            ]);

            Storage::putFileAs(
                'public/surat/syarat/bedaNama',
                $request->file('file_surat'),
                $request->jenis_surat . '_' . $request->nama_yang_tertera . '_' . time() . '.' . $request->file('file_surat')->extension()
            );
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_penghasilan') {
            //
            $request->validate([
                'penghasilan' => ['required'],
                'bukti_penghasilan' => ['required', 'file', 'max:7168'],

                'keperluan' => ['required', 'min:8'],
                'pesan' => ['required', 'min:8'],
                'keterangan' => ['nullable'],
            ]);

            $user = Auth::user();

            $surat = $jenisSurat->surat()->create([
                'user_id' => $user->id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'keterangan' => $request->keterangan,
            ]);

            $surat->penghasilan()->create([
                'penghasilan' => $request->penghasilan,
                'bukti_penghasilan' => 'bedanama_' . $user->nama . '_' . time() . '.' . $request->file('bukti_penghasilan')->extension(),
            ]);

            Storage::putFileAs(
                'public/surat/syarat/penghasilan',
                $request->file('bukti_penghasilan'),
                'bedanama_' . $user->nama . '_' . time() . '.' . $request->file('bukti_penghasilan')->extension()
            );
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_harga_tanah') {
            //
            $request->validate([
                'nomor_sertifikat' => ['required'],
                'atas_nama_sertifikat' => ['required'],
                'luas_tanah' => ['required'],
                'batas_tanah_utara' => ['required'],
                'batas_tanah_selatan' => ['required'],
                'batas_tanah_timur' => ['required'],
                'batas_tanah_barat' => ['required'],
                'harga_tafsiran_tanah' => ['required'],
                'harga_tafsiran_bangunan' => ['required'],
                'fileSertifikatTanah' => ['required', 'file', 'max:7168'],

                'keperluan' => ['required', 'min:8'],
                'pesan' => ['required', 'min:8'],
                'keterangan' => ['nullable'],
            ]);

            $user = Auth::user();

            $surat = $jenisSurat->surat()->create([
                'user_id' => $user->id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'keterangan' => $request->keterangan,
            ]);

            $surat->hargaTanah()->create([
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'atas_nama_sertifikat' => $request->atas_nama_sertifikat,
                'luas_tanah' => $request->luas_tanah,
                'batas_tanah_utara' => $request->batas_tanah_utara,
                'batas_tanah_selatan' => $request->batas_tanah_selatan,
                'batas_tanah_timur' => $request->batas_tanah_timur,
                'batas_tanah_barat' => $request->batas_tanah_barat,
                'harga_tafsiran_tanah' => $request->harga_tafsiran_tanah,
                'harga_tafsiran_bangunan' => $request->harga_tafsiran_bangunan,
                'fileSertifikatTanah' => $request->atas_nama_sertifikat . '_' . $request->nomor_sertifikat . '_' . time() . '.' . $request->file('fileSertifikatTanah')->extension(),
            ]);

            Storage::putFileAs(
                'public/surat/syarat/hargaTanah',
                $request->file('fileSertifikatTanah'),
                $request->atas_nama_sertifikat . '_' . $request->nomor_sertifikat . '_' . time() . '.' . $request->file('fileSertifikatTanah')->extension()
            );
            //
        }

        return redirect()
            ->route('warga.surat.index')
            ->with('success', 'Pengajuan Surat Berhasil Dikirim');
    }

    public function showResult(Administrasi $administrasi)
    {
        if ($administrasi->jenis->slug == 'surat_keterangan_usaha') {
            $pdfUrl = Storage::path('public/surat/result/usaha/' . $administrasi->file_surat);
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_tidak_mampu') {
            $pdfUrl = Storage::path('public/surat/result/kurangMampu/' . $administrasi->file_surat);
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_belum_pernah_menikah') {
            $pdfUrl = Storage::path('public/surat/result/belumMenikah/' . $administrasi->file_surat);
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_beda_nama') {
            $pdfUrl = Storage::path('public/surat/result/bedaNama/' . $administrasi->file_surat);
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_penghasilan') {
            $pdfUrl = Storage::path('public/surat/result/penghasilan/' . $administrasi->file_surat);
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_harga_tanah') {
            $pdfUrl = Storage::path('public/surat/result/hargaTanah/' . $administrasi->file_surat);
        }
        return response()->file($pdfUrl);
    }
}
