<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\News\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\News\Category;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function indexWarga()
    {
        $news = News::where('role', 0)
            ->orderBy('id', 'desc')
            ->get();
        return view('page.admin.news.indexWarga', compact('news'));
    }

    public function indexKelurahan()
    {
        $news = News::where('role', 1)
            ->orderBy('id', 'desc')
            ->get();
        return view('page.admin.news.indexKelurahan', compact('news'));
    }

    public function createNews()
    {
        return view('page.admin.news.create');
    }

    public function storeNews(Request $request)
    {
        $file = $request->file('photo');
        $extension = $file->getClientOriginalName();
        $filename = time() . '.' . $extension;
        $file->move('avatars', $filename);

        return $extension;
    }

    public function showNews(News $news)
    {
        return $news;
    }

    public function indexCategory()
    {
        $category = Category::all();
        return view('page.admin.news.category.index', compact('category'));
    }

    public function showCategory(Category $category)
    {
        return view('page.admin.news.category.show', compact('category'));
    }
}
