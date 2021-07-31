<?php

namespace App\Http\Controllers\Admin\News;

use App\Models\User;
use App\Models\News\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\News\Category;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::latest()
            ->get();
        return view('page.admin.news.index', compact('news'));
    }

    public function createNews()
    {
        return view('page.admin.news.create');
    }

    public function storeNews(NewsRequest $request)
    {
        $image = $request->file('photo');
        $fileName = time() . '.' . $image->getClientOriginalName();
        $image->move('image/news', $fileName);

        if (Auth::user()->getRoleNames()[0] == "admin" || Auth::user()->getRoleNames()[0] == "petugas") {
            $role = 1;
        } else {
            $role = 0;
        }

        $news = Auth::user()->news()->create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::of($request->title)->slug('_'),
            'photo' => $fileName,
            'description' => $request->description,
            'role' => $role,
        ]);

        return redirect()->route('admin.news.show', $news->slug)->with('success', 'Berita Berhasil Ditambahkan');
    }

    public function showNews(News $news)
    {
        return view('page.admin.news.show', compact(('news')));
    }

    public function putNews(Request $request, News $news)
    {
        if ($news->title != $request->title) {
            $request->validate([
                'title' => 'required|string|unique:news|min:8|max:60',
            ]);
        }

        $request->validate([
            'photo' => 'image',
            'category_id' => 'required',
            'description' => 'required|min:30',
        ]);

        if ($request->has('photo')) {
            $image = $request->file('photo');
            $fileName = time() . '.' . $image->getClientOriginalName();
            $image->move('image/news', $fileName);
        } else {
            $fileName = $news->photo;
        }

        $takeCharacters = substr($request->description, 0, 3);
        $compareCharacters = '<p>';
        if ($takeCharacters == $compareCharacters) {
            $description = $request->description;
        } else {
            $description = '<p>' . $request->description . '</p>';
        }

        News::where('slug', $news->slug)
            ->update([
                'title' => $request->title,
                'slug' => Str::of($request->title)->slug('-'),
                'photo' => $fileName,
                'category_id' => $request->category_id,
                'description' => $description,
            ]);

        $slug = Str::of($request->title)->slug('-');

        return redirect()->route('admin.news.show', $slug)->with('success', 'Berita Berhasil Diubah!');
    }

    public function hideNews(Request $request, News $news)
    {
        News::where('id', $news->id)
            ->update([
                'show' => 0
            ]);

        return back()->with('info', 'Berita Berhasil Disembunyikan');
    }

    public function showNewsPut(Request $request, News $news)
    {
        News::where('id', $news->id)
            ->update([
                'show' => 1
            ]);

        return back()->with('info', 'Berita Berhasil Ditampilkan');
    }

    public function indexCategory()
    {
        $category = Category::query()
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('page.admin.news.category.index', compact('category'));
    }

    public function storeCategory(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('_')
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function showCategory(Category $category)
    {
        return view('page.admin.news.category.show', compact('category'));
    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        Category::where('id', $category->id)
            ->update([
                'name' => $request->name,
                'slug' => Str::of($request->name)->slug('_')
            ]);

        return back()->with('success', 'Kategori berhasil diubah!');
    }
}
