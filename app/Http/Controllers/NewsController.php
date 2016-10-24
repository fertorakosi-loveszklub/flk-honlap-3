<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Auth;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['admin_module' => 'news']);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Article::orderBy('id', 'desc')->get();

        return view('admin.news', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news-form', [
            'article' => new Article(['published_at' => Carbon::now()])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        Auth::user()->articles()->create($request->all());

        return redirect()->route('news.index')->with('status', [
            'type' => 'success',
            'message' => 'Cikk sikeresen létrehozva'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('pages.article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.news-form', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArticleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->fill($request->all());

        if (!$request->get('is_visible')) {
            $article->is_visible = false;
        }

        $article->save();

        return redirect('/admin/news')->with('status', [
            'type' => 'success',
            'message' => 'Cikk sikeresen frissítve'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::destroy($id);
        return redirect('/admin/news')->with('status', [
            'type' => 'success',
            'message' => 'Cikk sikeresen törölve'
        ]);
    }

    public function showList()
    {
        $articles = Article::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.article-list', compact('articles'));
    }
}
