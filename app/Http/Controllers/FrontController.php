<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class FrontController extends Controller
{
    public function index() {
        $articles = Article::paginate(5);

        return view('blog.home', [
            'articles' => $articles
        ]);
    }
}
