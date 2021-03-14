<?php

namespace App\Http\Controllers\News;

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
        return $category;
    }
}
