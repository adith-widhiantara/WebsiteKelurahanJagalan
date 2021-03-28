<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('page.admin.landing.index');

        // $data = Aduan::select('id', 'progress', 'created_at')
        //     ->where('progress', '<', 80)
        //     ->get()
        //     ->groupBy(function ($val) {
        //         return Carbon::parse($val->created_at)->format('m');
        //     });

        // return $data['02']->count();
    }
}
