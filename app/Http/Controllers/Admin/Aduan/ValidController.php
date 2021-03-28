<?php

namespace App\Http\Controllers\Admin\Aduan;

use App\Http\Controllers\Controller;
use App\Models\Aduan\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidController extends Controller
{
    public function store(Request $request, Aduan $aduan)
    {
        $aduan->update([
            'progress' => 1
        ]);

        $validAduan = $aduan->valid()->create([
            'user_id' => Auth::id()
        ]);

        $validAduan->commentRW()->create();

        return back()->with('success', 'Aduan Diterima!');
    }
}
