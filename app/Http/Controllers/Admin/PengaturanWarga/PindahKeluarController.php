<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PengaturanWarga\PindahMasuk;
use App\Models\PengaturanWarga\PindahKeluar;

class PindahKeluarController extends Controller
{
    public function index()
    {
        $dataPindahKeluar = PindahKeluar::latest()
            ->get();
        $dataKartuKeluarga = KartuKeluarga::all();

        return view('page.admin.pengaturanWarga.pindahKeluar.index', compact('dataPindahKeluar', 'dataKartuKeluarga'));
    }

    public function create(KartuKeluarga $kartuKeluarga)
    {
        $user = User::with('anggota.kartu')
            ->doesntHave('kematian')
            ->doesntHave('keluar')
            ->whereHas('anggota.kartu', function (Builder $query) use ($kartuKeluarga) {
                $query->where('id', $kartuKeluarga->id);
            })->get();

        return view('page.admin.pengaturanWarga.pindahKeluar.create', compact('kartuKeluarga', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_tujuan' => ['required', 'min:8'],
            'tanggal_surat' => ['required', 'date'],
            'nomor_surat' => ['required', 'min:8'],
            'file_surat' => ['required', 'file', 'max:5120'],
            'keterangan' => ['nullable'],
        ]);

        $user = User::findOrFail($request->user_id);

        $user->keluar()->create([
            'alamat_tujuan' => $request->alamat_tujuan,
            'tanggal_surat' => $request->tanggal_surat,
            'nomor_surat' => $request->nomor_surat,
            'file_surat' => $user->id . '_' . $request->file('file_surat')->getClientOriginalName(),
            'keterangan' => $request->keterangan,
        ]);

        $request->file('file_surat')->storeAs(
            'public/berkas_pindah_keluar',
            $user->id . '_' . $request->file('file_surat')->getClientOriginalName()
        );

        return redirect()->route('admin.pindahkeluar.index')->with('success', 'Data Pindah Keluar Berhasil Ditambahkan');
    }

    public function show($pindahKeluar)
    {
        $dataPindahKeluar = PindahKeluar::with('user')->find($pindahKeluar);

        return view('page.admin.pengaturanWarga.pindahKeluar.show', compact('dataPindahKeluar'));
    }

    public function showFile(PindahKeluar $pindahKeluar)
    {
        $path = Storage::path('public/berkas_pindah_keluar/' . $pindahKeluar->file_surat);
        return response()->file($path);
    }

    public function showPDF($pindahKeluar)
    {
        $dataPindahKeluar = PindahKeluar::with('user.anggota.kartu')
            ->findOrFail($pindahKeluar);

        $data = [
            'data' => [
                'logo' => 'image/assets/Logo-Kota-Kediri.png',
                'alamat' => 'Jl. Patiunus No.69, Jagalan, Kec. Kota Kediri, Kota Kediri, Jawa Timur 64129',
                'nomor_surat' => [
                    'format' => 'surat_pindah_keluar/',
                    'index' => $dataPindahKeluar->id
                ]
            ],
            'self' => [
                'nama' => $dataPindahKeluar->user->nama,
                'tempat_lahir' => $dataPindahKeluar->user->anggota->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($dataPindahKeluar->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                'jenis_kelamin' => $dataPindahKeluar->user->anggota->jenis_kelamin,
                'pekerjaan' => $dataPindahKeluar->user->anggota->pekerjaan->keterangan,
                'alamat' => $dataPindahKeluar->user->anggota->kartu->alamat,
            ],
            'pindahKeluar' => [
                'alamat' => $dataPindahKeluar->alamat_tujuan,
                'tanggal' => Carbon::parse($dataPindahKeluar->tanggal_surat)->isoFormat('D MMMM Y'),
                'nomor' => $dataPindahKeluar->nomor_surat,
                'keterangan' => $dataPindahKeluar->keterangan,
            ],
            'bottom' => [
                'place' => 'Kediri',
                'date' => now()->isoFormat('D MMMM Y'),
                'ttd' => 'image/assets/ttd.png',
                'person' => 'Drs. John Doe'
            ],
        ];

        $fileName =  Str::slug($data['data']['nomor_surat']['format'] . ' ' . $data['data']['nomor_surat']['index'] . ' ' . $data['self']['nama'], '_') . '.pdf';

        if (Storage::disk('local')->exists('public/pindah_keluar/result/' . $fileName)) {
            $pdfUrl = Storage::path('public/pindah_keluar/result/' . $fileName);
            return response()->file($pdfUrl);
        }

        $pdf = PDF::loadView('page.admin.pengaturanWarga.pindahKeluar.showPDF', ['data' => $data]);
        $pdf->save(base_path() . '/storage/app/public/pindah_keluar/result/pindah_keluar.pdf');
        Storage::move('public/pindah_keluar/result/pindah_keluar.pdf', 'public/pindah_keluar/result/' . $fileName);

        $pdfUrl = Storage::path('public/pindah_keluar/result/' . $fileName);
        return response()->file($pdfUrl);
    }
}
