<?php

namespace App\Http\Controllers\Api;

use App\Article;

class ArticleController
{
    public function index()
    {
        $articles = Article::published()
            ->latest('published_at')
            ->with('author')
            ->limit(12)
            ->get();

        return $articles;
    }

    public function latest()
    {
        $articles = Article::published()
            ->latest('published_at')
            ->with('author')
            ->limit(3)
            ->get();

        return $articles;
    }

    public function show($slug)
    {
        return Article::where('slug', $slug)->firstOrFail();
    }
}
