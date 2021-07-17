<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PengaturanWebsite;
use App\Http\Controllers\Controller;

class PengaturanWebController extends Controller
{
    public function index()
    {
        $data = [
            'deskripsi' => PengaturanWebsite::where('name', 'deskripsi_website')->first()->description,
            'telepon' => PengaturanWebsite::where('name', 'telepon')->first()->description,
            'whatsapp_text' => PengaturanWebsite::where('name', 'whatsapp_text')->first()->description,
            'home' => PengaturanWebsite::where('name', 'home')->first()->description,
            'email' => PengaturanWebsite::where('name', 'email')->first()->description,
            'alamat' => PengaturanWebsite::where('name', 'alamat')->first()->description,
        ];

        return view('page.admin.pengaturanWeb.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi_website' => ['required'],
            'telepon' => ['required'],
            'whatsapp_text' => ['required'],
            'home' => ['required'],
            'email' => ['required', 'email'],
            'alamat' => ['required'],
            'imageBantuan' => ['nullable', 'image'],
        ]);

        if ($request->file('imageBantuan')) {
            $fileName = 'bantuanBG.' . $request->file('imageBantuan')->extension();
            $request->file('imageBantuan')->storeAs(
                'public/pengaturan/bantuanBG',
                $fileName
            );

            PengaturanWebsite::updateOrCreate(['name' => 'image_bantuan'], ['description' => $fileName]);
        }

        PengaturanWebsite::where('name', 'deskripsi_website')->first()->update(['description' => $request->deskripsi_website]);
        PengaturanWebsite::where('name', 'telepon')->first()->update(['description' => $request->telepon]);
        PengaturanWebsite::where('name', 'whatsapp_text')->first()->update(['description' => $request->whatsapp_text]);
        PengaturanWebsite::where('name', 'whatsapp_text_render')->first()->update(['description' => Str::slug($request->whatsapp_text, '%20')]);
        PengaturanWebsite::where('name', 'home')->first()->update(['description' => $request->home]);
        PengaturanWebsite::where('name', 'email')->first()->update(['description' => $request->email]);
        PengaturanWebsite::where('name', 'alamat')->first()->update(['description' => $request->alamat]);

        return back()
            ->with('success', 'Data Berhasil Diperbarui');
    }

    public function storePencapaian(Request $request)
    {
        $request->validate([
            'deskripsi_penghargaan' => ['required', 'min:8'],
            'deskripsi_penghargaan_1' => ['required', 'min:8'],
            'deskripsi_penghargaan_2' => ['required', 'min:8'],
            'deskripsi_penghargaan_3' => ['required', 'min:8'],
            'imagePenghargaan' => ['nullable', 'image']
        ]);

        if ($request->file('imagePenghargaan')) {
            $fileName = 'penghargaanBG.' . $request->file('imagePenghargaan')->extension();
            $request->file('imagePenghargaan')->storeAs(
                'public/pengaturan/penghargaanBG',
                $fileName
            );

            PengaturanWebsite::updateOrCreate(['name' => 'image_penghargaan'], ['description' => $fileName]);
        }

        PengaturanWebsite::where('name', 'deskripsi_penghargaan')->first()->update(['description' => $request->deskripsi_penghargaan]);
        PengaturanWebsite::where('name', 'deskripsi_penghargaan_1')->first()->update(['description' => $request->deskripsi_penghargaan_1]);
        PengaturanWebsite::where('name', 'deskripsi_penghargaan_2')->first()->update(['description' => $request->deskripsi_penghargaan_2]);
        PengaturanWebsite::where('name', 'deskripsi_penghargaan_3')->first()->update(['description' => $request->deskripsi_penghargaan_3]);

        return back()
            ->with('success', 'Data Berhasil Diperbarui');
    }
}
