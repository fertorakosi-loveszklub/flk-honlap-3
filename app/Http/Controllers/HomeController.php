<?php
/**
 * (c) 2016. 10. 13..
 * Authors: nxu
 */

namespace App\Http\Controllers;

use App\Article;

class HomeController extends Controller
{
    public function index()
    {
        $news = Article::published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('pages.home', compact('news'));
    }

    public function adminIndex()
    {
        return redirect('/admin/news');
    }
}
