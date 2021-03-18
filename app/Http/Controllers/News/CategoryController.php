<?php

namespace App\Http\Controllers\News;

use App\Models\News\News;
use Illuminate\Http\Request;
use App\Models\News\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function show(Category $category)
    {
        $news = News::where('category_id', $category->id)->paginate(6);

        return view('page.news.category.show', compact('category', 'news'));
    }
}
