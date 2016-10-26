<?php

namespace App\Http\Controllers;

use App\Page;
use App\Http\Requests\PageRequest;
use Imgur\Client;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['admin_module' => 'page']);
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
        $pages = Page::orderBy('id', 'desc')->get();

        return view('admin.pages', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page-form', ['page' => new Page()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create($request->all());

        return redirect()->route('pages.index')->with('status', [
            'type' => 'success',
            'message' => 'Galéria sikeresen létrehozva'
        ]);

    }

    public function showList()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('pages.page-list', compact('pages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {
        if (! $page) {
            abort(404);
        }

        return view('pages.page', compact('page'));
    }

    public function showAbout()
    {
        $page = Page::where('slug', 'rolunk')->first();
        return $this->show($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.page-form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PageRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update($request->all());

        return redirect('/admin/pages')->with('status', [
            'type' => 'success',
            'message' => 'Galéria sikeresen frissítve'
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
        Page::destroy($id);

        return redirect('/admin/pages')->with('status', [
            'type' => 'success',
            'message' => 'Galéria sikeresen frissítve'
        ]);
    }
}
