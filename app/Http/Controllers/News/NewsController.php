<?php

namespace App\Http\Controllers\News;

use App\Models\News\News;
use Illuminate\Http\Request;

use App\Models\News\Category;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = News::where('show', 1)
            ->latest()
            ->paginate(6);
        $recentNews = News::where('show', 1)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
        $categoryList = Category::all();

        return view('page.news.index', compact('allNews', 'recentNews', 'categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        if ($news->show == 0) {
            return view('page.news.404');
        }

        $recentNews = News::where('show', 1)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
        $categoryList = Category::all();

        return view('page.news.show', compact('news', 'categoryList', 'recentNews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
