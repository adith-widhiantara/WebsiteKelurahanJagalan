<?php

namespace App\Http\Controllers\Admin\Pengurus;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\PengurusPegawaiRequest;
use App\Models\Admin\Pengurus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurusUser = User::query()
            ->wherehas('roles', function (Builder $query) {
                $query->where('name', 'petugas');
            })
            ->with('roles')
            ->get();

        $kepalaKelurahanUser = User::query()
            ->wherehas('roles', function (Builder $query) {
                $query->where('name', 'kepala_kelurahan');
            })
            ->with('roles')
            ->first();

        $RwDanRtData = [
            [
                'nama' => User::whereHas('pengurus', function (Builder $query) {
                    $query->where('bagian_kerja', 'RW 1');
                })->first(),
                'bagian' => 'RW 1'
            ],
            [
                'nama' => User::whereHas('pengurus', function (Builder $query) {
                    $query->where('bagian_kerja', 'RW 1 RT 1');
                })->first(),
                'bagian' => 'RW 1 RT 1'
            ],
            [
                'nama' => User::whereHas('pengurus', function (Builder $query) {
                    $query->where('bagian_kerja', 'RW 1 RT 2');
                })->first(),
                'bagian' => 'RW 1 RT 2'
            ],
            [
                'nama' => User::whereHas('pengurus', function (Builder $query) {
                    $query->where('bagian_kerja', 'RW 2');
                })->first(),
                'bagian' => 'RW 2'
            ],
            [
                'nama' => User::whereHas('pengurus', function (Builder $query) {
                    $query->where('bagian_kerja', 'RW 2 RT 1');
                })->first(),
                'bagian' => 'RW 2 RT 1'
            ],
            [
                'nama' => User::whereHas('pengurus', function (Builder $query) {
                    $query->where('bagian_kerja', 'RW 2 RT 2');
                })->first(),
                'bagian' => 'RW 2 RT 2'
            ],
        ];

        $dataKartuKeluarga = KartuKeluarga::all();

        return view('page.admin.pengurus.index', compact('pengurusUser', 'dataKartuKeluarga', 'kepalaKelurahanUser', 'RwDanRtData'));
    }

    public function profilSaya()
    {
        $user = User::query()
            ->where('id', Auth::id())
            ->with('pengurus')
            ->first();

        return view('page.admin.pengurus.profilSaya', compact('user'));
    }

    public function putProfilSaya(Request $request)
    {
        $request->validate([
            'nomor_telepon' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'alamat' => Rule::requiredIf(!Auth::user()->pengurus->warga_jagalan),
            'foto' => ['image', 'max:2048'],
            'password' => ['nullable'],
        ]);

        if ($request->file('foto')) {
            $namePoto = Auth::id() . '-' . Auth::user()->nama . '-' . time() . '.' . $request->file('foto')->extension();

            Storage::putFileAs(
                'public/user/foto',
                $request->file('foto'),
                $namePoto
            );

            Auth::user()->update([
                'foto' => $namePoto,
            ]);
        }

        Auth::user()->update([
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::user()->pengurus()->update([
            'alamat' => $request->alamat,
        ]);

        return back()
            ->with('success', 'Data anda berhasil diubah');
    }

    public function pegawaiStore(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'unique:users_data_pengurus,user_id'],
            'bagian_kerja' => ['required'],
        ]);

        $user = User::firstWhere('id', $request->user_id);
        $user->assignRole('petugas');
        $user->pengurus()
            ->create([
                'warga_jagalan' => 1,
                'bagian_kerja' => $request->bagian_kerja,
            ]);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus Berhasil Ditambahkan');
    }

    public function create()
    {
        return view('page.admin.pengurus.create');
    }

    public function store(PengurusPegawaiRequest $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'nomor_ktp' => $request->nomor_ktp,
            'password' => Hash::make('password'),
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        $user->assignRole('petugas');
        $user->pengurus()
            ->create([
                'warga_jagalan' => 0,
                'alamat' => $request->alamat,
                'bagian_kerja' => $request->bagian_kerja,
            ]);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data Pengurus Berhasil Ditambahkan');
    }

    public function showPegawai(User $user)
    {
        $user = $user->load('pengurus');

        if (!$user->pengurus) {
            return back()
                ->with('error', 'Gabisa');
        }
        return view('page.admin.pengurus.show', compact('user'));
    }

    public function deletePegawai(Request $request, User $user)
    {
        if (!$user->hasRole('petugas')) {
            return back()
                ->with('warning', 'Akun ini bukan petugas');
        }

        $user->removeRole('petugas');

        if ($user->pengurus) {
            $user->pengurus()->delete();
        }

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Akun berhasil dihapus dari pengurus');
    }

    public function kepalaKelurahanCreate()
    {
        return view('page.admin.pengurus.createKepalaKelurahan');
    }

    public function kepalaKelurahanStoreNew(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:users'],
            'nomor_ktp' => ['required', 'string', 'unique:users'],
            'nomor_telepon' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'email' => ['nullable', 'email'],
        ]);

        $this->revokeKepalaKelurahan();

        $lastKepalaKelurahan = Pengurus::firstWhere('bagian_kerja', 'Kepala Kelurahan');
        $lastKepalaKelurahanIDUser = $lastKepalaKelurahan->user_id;

        $user = User::create([
            'nama' => $request->nama,
            'nomor_ktp' => $request->nomor_ktp,
            'password' => Hash::make('password'),
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        $user->assignRole('kepala_kelurahan');

        Pengurus::updateOrCreate(
            [
                'bagian_kerja' => 'Kepala Kelurahan'
            ],
            [
                'user_id' => $user->id,
                'terakhir_masuk_sistem' => null,
                'warga_jagalan' => 0,
                'alamat' => $request->alamat,
            ]
        );

        $lastKepalaKelurahanIDUserCheck = User::find($lastKepalaKelurahanIDUser);
        if (empty($lastKepalaKelurahanIDUserCheck->anggota)) {
            User::find($lastKepalaKelurahanIDUser)->delete();
        }

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Kepala Kelurahan Berhasil Didata!');
    }

    public function kepalaKelurahanStore(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'unique:users_data_pengurus,user_id']
        ]);

        $this->revokeKepalaKelurahan();

        $lastKepalaKelurahan = Pengurus::firstWhere('bagian_kerja', 'Kepala Kelurahan');
        $lastKepalaKelurahanIDUser = $lastKepalaKelurahan->user_id;

        $user = User::firstWhere('id', $request->user_id);
        $user->assignRole('kepala_kelurahan');

        Pengurus::updateOrCreate(
            [
                'bagian_kerja' => 'Kepala Kelurahan'
            ],
            [
                'user_id' => $user->id,
                'terakhir_masuk_sistem' => null,
                'warga_jagalan' => 1,
                'alamat' => null,
            ]
        );

        $lastKepalaKelurahanIDUserCheck = User::find($lastKepalaKelurahanIDUser);
        if (empty($lastKepalaKelurahanIDUserCheck->anggota)) {
            User::find($lastKepalaKelurahanIDUser)->delete();
        }

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Kepala Kelurahan Berhasil Didata!');
    }

    public function dataRtRwStore(Request $request, $dataRtRw = null)
    {
        $request->validate([
            'user_id' => ['required', 'unique:users_data_pengurus,user_id'],
            'bagian_kerja' => ['required']
        ]);

        $user = User::firstWhere('id', $request->user_id);

        if (isset($dataRtRw)) {
            $lastUser = User::firstWhere('id', $dataRtRw);
            $lastUser->removeRole('RT');
            $lastUser->removeRole('RW');
        }

        if ($request->bagian_kerja == 'RW 1' || $request->bagian_kerja == 'RW 2') {
            $user->assignRole('RW');
            Pengurus::updateOrCreate(
                [
                    'bagian_kerja' => $request->bagian_kerja
                ],
                [
                    'user_id' => $user->id,
                    'warga_jagalan' => 1,
                    'terakhir_masuk_sistem' => null
                ]
            );
        } else {
            $user->assignRole('RT');
            Pengurus::updateOrCreate(
                [
                    'bagian_kerja' => $request->bagian_kerja
                ],
                [
                    'user_id' => $user->id,
                    'warga_jagalan' => 1,
                    'terakhir_masuk_sistem' => null
                ]
            );
        }

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data RT & RW berhasil diperbarui');
    }

    public function dataRtRwShow(User $user)
    {
        $user = $user->load('pengurus');

        return view('page.admin.pengurus.showDataRwRt', compact('user'));
    }

    public function revokeKepalaKelurahan()
    {
        $kepalaKelurahanUser = User::query()
            ->wherehas('roles', function (Builder $query) {
                $query->where('name', 'kepala_kelurahan');
            })
            ->first();
        if (isset($kepalaKelurahanUser)) {
            $kepalaKelurahanUser->removeRole('kepala_kelurahan');
        }
    }

    public function dropdown($kartuKeluarga)
    {
        $dataAnggotaKeluarga = User::with('anggota.kartu')
            ->doesntHave('kematian')
            ->doesntHave('keluar')
            ->doesntHave('pengurus')
            ->whereHas('anggota.kartu', function (Builder $query) use ($kartuKeluarga) {
                $query->where('id', $kartuKeluarga);
            })
            ->get();

        return json_encode($dataAnggotaKeluarga);
    }
}
