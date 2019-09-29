<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function category($slug) {
        $category = Category::where('slug', $slug)->first();

        return view('blog.category', [
            'category' => $category,
            'articles' => $category->articles()->where('published', 1)->paginate(12)
        ]);
    }

    public function categories() {
        $categories = Category::all();

        //return view('blog.categories', [
        return view('blog.category', [
            'categories' => $categories
        ]);
    }
}
