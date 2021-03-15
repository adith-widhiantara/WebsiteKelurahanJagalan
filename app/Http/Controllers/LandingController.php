<?php

namespace App\Http\Controllers;

use App\Models\News\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $recentNews = News::orderBy('id', 'desc')
            ->take(2)
            ->get();

        return view('page.landing.index', compact('recentNews'));
    }
}
