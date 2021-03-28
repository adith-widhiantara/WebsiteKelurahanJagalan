<?php

namespace App\Http\Controllers\Admin\Aduan;

use App\Models\Aduan\Aduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TolakController extends Controller
{
    public function store(Request $request, Aduan $aduan)
    {
        $request->validate([
            'comment' => 'required|string|min:8',
            'foto' => 'required',
            'foto.*' => 'image'
        ]);

        $aduanNonValid = $aduan->nonValid()->create();

        $aduanNonValid->comment()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id()
        ]);

        foreach ($request->file('foto') as $image) {
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move('image/aduan/nonValid', $name);

            $aduanNonValid->foto()->create([
                'photo' => $name,
                'user_id' => Auth::id()
            ]);
        }

        return back()->with('success', 'Aduan Ditolak!');
    }
}
