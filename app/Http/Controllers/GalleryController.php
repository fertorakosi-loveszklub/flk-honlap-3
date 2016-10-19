<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\GalleryRequest;
use Imgur\Client;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();

        return view('admin.galleries', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery-form', ['gallery' => new Gallery()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        Gallery::create($request->all());

        return redirect()->route('galleries.index')->with('status', [
            'type' => 'success',
            'message' => 'Galéria sikeresen létrehozva'
        ]);

    }

    public function showList()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $gallery = Gallery::findBySlugOrFail($slug);
        $images = $gallery->getImages();

        return view('pages.gallery', compact('gallery', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery-form', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GalleryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->update($request->all());

        return redirect('/admin/galleries')->with('status', [
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
        Gallery::destroy($id);

        return redirect('/admin/galleries')->with('status', [
            'type' => 'success',
            'message' => 'Galéria sikeresen frissítve'
        ]);
    }
}
