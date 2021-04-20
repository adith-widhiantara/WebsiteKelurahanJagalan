<?php

namespace App\Http\Controllers\Admin\Surat;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Surat\Jenis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Surat\Administrasi;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class SuratController extends Controller
{
    public function index()
    {
        $dataSurat = Administrasi::with('jenis')
            ->latest()
            ->get();
        $dataJenisSurat = Jenis::all();


        return view('page.admin.surat.index', compact('dataSurat', 'dataJenisSurat'));
    }

    public function create($jenisSurat)
    {
        $dataJenisSurat = Jenis::firstWhere('slug', $jenisSurat);
        $dataKartuKeluarga = KartuKeluarga::all();

        if ($dataJenisSurat->slug == 'surat_keterangan_usaha') {
            return view('page.admin.surat.create.suratKeteranganUsaha', compact('dataJenisSurat', 'dataKartuKeluarga'));
        } elseif ($dataJenisSurat->slug == 'surat_keterangan_tidak_mampu') {
            return view('page.admin.surat.create.suratKeteranganTidakMampu', compact('dataJenisSurat', 'dataKartuKeluarga'));
        } elseif ($dataJenisSurat->slug == 'surat_keterangan_belum_pernah_menikah') {
            return view('page.admin.surat.create.suratKeteranganBelumPernahMenikah', compact('dataJenisSurat', 'dataKartuKeluarga'));
        } elseif ($dataJenisSurat->slug == 'surat_keterangan_beda_nama') {
            return view('page.admin.surat.create.suratBedaNama', compact('dataJenisSurat', 'dataKartuKeluarga'));
        } elseif ($dataJenisSurat->slug == 'surat_keterangan_penghasilan') {
            return view('page.admin.surat.create.suratKeteranganPenghasilan', compact('dataJenisSurat', 'dataKartuKeluarga'));
        } elseif ($dataJenisSurat->slug == 'surat_keterangan_harga_tanah') {
            return view('page.admin.surat.create.suratKeteranganHargaTanah', compact('dataJenisSurat', 'dataKartuKeluarga'));
        }
    }

    public function dropdown($kartuKeluarga)
    {
        $dataAnggotaKeluarga = User::with('anggota.kartu')
            ->doesntHave('kematian')
            ->doesntHave('keluar')
            ->whereHas('anggota.kartu', function (Builder $query) use ($kartuKeluarga) {
                $query->where('id', $kartuKeluarga);
            })->get();

        return json_encode($dataAnggotaKeluarga);
    }

    public function store(Request $request, $jenisSurat)
    {
        $jenisSurat = Jenis::firstWhere('slug', $jenisSurat);

        if ($jenisSurat->slug == 'surat_keterangan_usaha') {
            //
            $request->validate([
                'keperluan' => ['required', 'min:8'],
                'pesan' => ['required', 'min:8'],
                'keterangan' => ['nullable'],
                'sejak' => ['required'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => $request->user_id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'status' => true,
                'keterangan' => $request->keterangan,
            ]);

            $surat->usaha()->create([
                'sejak' => $request->sejak
            ]);
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_tidak_mampu') {
            //
            $request->validate([
                'keperluan' => ['required', 'min:8'],
                'pesan' => ['required', 'min:8'],
                'keterangan' => ['nullable'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => $request->user_id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'status' => true,
                'keterangan' => $request->keterangan,
            ]);
            //
        } elseif ($jenisSurat->slug == 'surat_keterangan_belum_pernah_menikah') {
            //
            $request->validate([
                'keperluan' => ['required', 'min:8'],
                'pesan' => ['required', 'min:8'],
                'keterangan' => ['nullable'],
            ]);

            $surat = $jenisSurat->surat()->create([
                'user_id' => $request->user_id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'status' => true,
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

            $user = User::findOrfail($request->user_id);

            $surat = $jenisSurat->surat()->create([
                'user_id' => $user->id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'status' => true,
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

            $user = User::findOrfail($request->user_id);

            $surat = $jenisSurat->surat()->create([
                'user_id' => $user->id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'status' => true,
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

            $user = User::findOrfail($request->user_id);

            $surat = $jenisSurat->surat()->create([
                'user_id' => $user->id,
                'keperluan' => $request->keperluan,
                'pesan' => $request->pesan,
                'status' => true,
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

        $this->printPDF($surat);

        return redirect()->route('admin.surat.index')->with('success', 'Permintaan surat berhasil dibuat');
    }

    public function show($administrasi)
    {
        $dataSurat = Administrasi::with('jenis')
            ->with('hargaTanah')
            ->with('penghasilan')
            ->with('bedaNama')
            ->findOrFail($administrasi);

        return view('page.admin.surat.show', compact('dataSurat'));
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

    public function showResult(Administrasi $administrasi)
    {
        if (!$administrasi->file_surat) {
            $this->printPDF($administrasi);
        }
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

    public function printPDF($administrasi)
    {
        $data = [
            'header' => [
                'logo' => 'image/assets/Logo-Kota-Kediri.png',
                'alamat' => 'Jl. Patiunus No.69, Jagalan, Kec. Kota Kediri, Kota Kediri, Jawa Timur 64129',
            ],
            'footer' => [
                'placeDate' => 'Kediri, ' . now()->isoFormat('D MMMM Y'),
                'ttd' => 'image/assets/ttd.png',
                'ttdblank' => 'image/assets/ttdblank.png',
                'person' => 'Drs. John Doe'
            ],
        ];

        if ($administrasi->jenis->slug == 'surat_keterangan_usaha') {
            //
            $surat = [
                'title' => $administrasi->jenis->nama_surat,
                'nomor_surat' => $administrasi->jenis->format_nomor_surat . '/' . $administrasi->id,
                'self' => [
                    'nama' => $administrasi->user->nama,
                    'nomorktp' => $administrasi->user->nomor_ktp,
                    'nik' => $administrasi->user->anggota->kartu->nomorkk,
                    'tempat_tanggal_lahir' => $administrasi->user->anggota->tempat_lahir . ', ' . Carbon::parse($administrasi->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                    'jenis_kelamin' => $administrasi->user->anggota->jenis_kelamin,
                    'status_perkawinan' => $administrasi->user->anggota->status_perkawinan->keterangan,
                    'alamat' => $administrasi->user->anggota->kartu->alamat,
                    'pekerjaan' => $administrasi->user->anggota->pekerjaan->keterangan,
                    'sejak' => $administrasi->usaha->sejak
                ],
            ];

            $fileName =  Str::slug($surat['nomor_surat'] . ' ' . $surat['self']['nama'], '_') . '.pdf';

            $administrasi->update([
                'file_surat' => $fileName
            ]);

            $pdf = PDF::loadView('page.admin.surat.print.suratKeteranganUsaha', ['data' => $data, 'surat' => $surat]);
            $pdf->save(base_path() . '/storage/app/public/surat/result/usaha/suratKeteranganUsaha.pdf');
            Storage::move('public/surat/result/usaha/suratKeteranganUsaha.pdf', 'public/surat/result/usaha/' . $fileName);
            //
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_tidak_mampu') {
            //
            $surat = [
                'title' => $administrasi->jenis->nama_surat,
                'nomor_surat' => $administrasi->jenis->format_nomor_surat . '/' . $administrasi->id,
                'self' => [
                    'nama' => $administrasi->user->nama,
                    'nomorktp' => $administrasi->user->nomor_ktp,
                    'nik' => $administrasi->user->anggota->kartu->nomorkk,
                    'tempat_tanggal_lahir' => $administrasi->user->anggota->tempat_lahir . ', ' . Carbon::parse($administrasi->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                    'jenis_kelamin' => $administrasi->user->anggota->jenis_kelamin,
                    'namaOrangTua' => $administrasi->user->anggota->nama_ayah . ' & ' . $administrasi->user->anggota->nama_ibu,
                    'alamat' => $administrasi->user->anggota->kartu->alamat,
                ],
            ];

            $fileName =  Str::slug($surat['nomor_surat'] . ' ' . $surat['self']['nama'], '_') . '.pdf';

            $administrasi->update([
                'file_surat' => $fileName
            ]);

            $pdf = PDF::loadView('page.admin.surat.print.suratKeteranganTidakMampu', ['data' => $data, 'surat' => $surat]);
            $pdf->save(base_path() . '/storage/app/public/surat/result/kurangMampu/suratKeteranganKurangMampu.pdf');
            Storage::move('public/surat/result/kurangMampu/suratKeteranganKurangMampu.pdf', 'public/surat/result/kurangMampu/' . $fileName);
            //
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_belum_pernah_menikah') {
            //
            $surat = [
                'title' => $administrasi->jenis->nama_surat,
                'nomor_surat' => $administrasi->jenis->format_nomor_surat . '/' . $administrasi->id,
                'self' => [
                    'nama' => $administrasi->user->nama,
                    'nomorktp' => $administrasi->user->nomor_ktp,
                    'nik' => $administrasi->user->anggota->kartu->nomorkk,
                    'tempat_tanggal_lahir' => $administrasi->user->anggota->tempat_lahir . ', ' . Carbon::parse($administrasi->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                    'jenis_kelamin' => $administrasi->user->anggota->jenis_kelamin,
                    'alamat' => $administrasi->user->anggota->kartu->alamat,
                    'pesan' => $administrasi->pesan,
                ],
            ];

            $fileName =  Str::slug($surat['nomor_surat'] . ' ' . $surat['self']['nama'], '_') . '.pdf';

            $administrasi->update([
                'file_surat' => $fileName
            ]);

            $pdf = PDF::loadView('page.admin.surat.print.suratKeteranganBelumPernahMenikah', ['data' => $data, 'surat' => $surat]);
            $pdf->save(base_path() . '/storage/app/public/surat/result/belumMenikah/suratKeteranganBelumMenikah.pdf');
            Storage::move('public/surat/result/belumMenikah/suratKeteranganBelumMenikah.pdf', 'public/surat/result/belumMenikah/' . $fileName);
            //
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_beda_nama') {
            //
            $surat = [
                'title' => $administrasi->jenis->nama_surat,
                'nomor_surat' => $administrasi->jenis->format_nomor_surat . '/' . $administrasi->id,
                'self' => [
                    'nama' => $administrasi->user->nama,
                    'nomorktp' => $administrasi->user->nomor_ktp,
                    'nik' => $administrasi->user->anggota->kartu->nomorkk,
                    'tempat_tanggal_lahir' => $administrasi->user->anggota->tempat_lahir . ', ' . Carbon::parse($administrasi->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                    'jenis_kelamin' => $administrasi->user->anggota->jenis_kelamin,
                    'pekerjaan' => $administrasi->user->anggota->pekerjaan->keterangan,
                    'alamat' => $administrasi->user->anggota->kartu->alamat,
                    'jenisKartu' => $administrasi->bedaNama->jenis_surat,
                    'namaTertera' => $administrasi->bedaNama->nama_yang_tertera,
                    'nomorTertera' => $administrasi->bedaNama->nomor_surat_tersebut,
                ],
            ];

            $fileName =  Str::slug($surat['nomor_surat'] . ' ' . $surat['self']['nama'], '_') . '.pdf';

            $administrasi->update([
                'file_surat' => $fileName
            ]);

            $pdf = PDF::loadView('page.admin.surat.print.suratKeteranganBedaNama', ['data' => $data, 'surat' => $surat]);
            $pdf->save(base_path() . '/storage/app/public/surat/result/bedaNama/suratKeteranganBedaNama.pdf');
            Storage::move('public/surat/result/bedaNama/suratKeteranganBedaNama.pdf', 'public/surat/result/bedaNama/' . $fileName);
            //
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_penghasilan') {
            //
            $surat = [
                'title' => $administrasi->jenis->nama_surat,
                'nomor_surat' => $administrasi->jenis->format_nomor_surat . '/' . $administrasi->id,
                'self' => [
                    'nama' => $administrasi->user->nama,
                    'nomorktp' => $administrasi->user->nomor_ktp,
                    'nik' => $administrasi->user->anggota->kartu->nomorkk,
                    'tempat_tanggal_lahir' => $administrasi->user->anggota->tempat_lahir . ', ' . Carbon::parse($administrasi->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                    'jenis_kelamin' => $administrasi->user->anggota->jenis_kelamin,
                    'pekerjaan' => $administrasi->user->anggota->pekerjaan->keterangan,
                    'alamat' => $administrasi->user->anggota->kartu->alamat,
                    'penghasilan' => 'Rp.' . number_format($administrasi->penghasilan->penghasilan, 2),
                    'keperluan' => $administrasi->keperluan,
                    'keterangan' => $administrasi->keterangan,
                ],
            ];

            $fileName =  Str::slug($surat['nomor_surat'] . ' ' . $surat['self']['nama'], '_') . '.pdf';

            $administrasi->update([
                'file_surat' => $fileName
            ]);

            $pdf = PDF::loadView('page.admin.surat.print.suratKeteranganPenghasilan', ['data' => $data, 'surat' => $surat]);
            $pdf->save(base_path() . '/storage/app/public/surat/result/penghasilan/suratKeteranganPenghasilan.pdf');
            Storage::move('public/surat/result/penghasilan/suratKeteranganPenghasilan.pdf', 'public/surat/result/penghasilan/' . $fileName);
            //
        } elseif ($administrasi->jenis->slug == 'surat_keterangan_harga_tanah') {
            //
            $surat = [
                'title' => $administrasi->jenis->nama_surat,
                'nomor_surat' => $administrasi->jenis->format_nomor_surat . '/' . $administrasi->id,
                'self' => [
                    'nama' => $administrasi->user->nama,
                    'nomorktp' => $administrasi->user->nomor_ktp,
                    'nik' => $administrasi->user->anggota->kartu->nomorkk,
                    'tempat_tanggal_lahir' => $administrasi->user->anggota->tempat_lahir . ', ' . Carbon::parse($administrasi->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                    'pekerjaan' => $administrasi->user->anggota->pekerjaan->keterangan,
                    'alamat' => $administrasi->user->anggota->kartu->alamat,
                    'nomor_sertifikat' => $administrasi->hargaTanah->nomor_sertifikat,
                    'atas_nama_sertifikat' => $administrasi->hargaTanah->atas_nama_sertifikat,
                    'luas_tanah' => $administrasi->hargaTanah->luas_tanah,
                    'utara' => $administrasi->hargaTanah->batas_tanah_utara,
                    'selatan' => $administrasi->hargaTanah->batas_tanah_selatan,
                    'timur' => $administrasi->hargaTanah->batas_tanah_timur,
                    'barat' => $administrasi->hargaTanah->batas_tanah_barat,
                    'harga_tafsiran_tanah' => 'Rp.' . number_format($administrasi->hargaTanah->harga_tafsiran_tanah, 2),
                    'harga_tafsiran_bangunan' => 'Rp.' . number_format($administrasi->hargaTanah->harga_tafsiran_bangunan, 2),
                ],
            ];

            $fileName =  Str::slug($surat['nomor_surat'] . ' ' . $surat['self']['nama'], '_') . '.pdf';

            $administrasi->update([
                'file_surat' => $fileName
            ]);

            $pdf = PDF::loadView('page.admin.surat.print.suratKeteranganHargaTanah', ['data' => $data, 'surat' => $surat]);
            $pdf->save(base_path() . '/storage/app/public/surat/result/hargaTanah/suratKeteranganHargaTanah.pdf');
            Storage::move('public/surat/result/hargaTanah/suratKeteranganHargaTanah.pdf', 'public/surat/result/hargaTanah/' . $fileName);
            //
        }
    }
}
