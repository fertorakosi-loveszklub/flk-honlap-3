<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\DocumentRequest;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['admin_module' => 'document']);
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
        $documents = Document::orderBy('id', 'desc')->get();

        return view('admin.documents', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.document-form', ['document' => new Document()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        Document::create([
            'title' => $request->get('title'),
            'file_path' => $this->saveFile($request)
        ]);

        return redirect()->route('documents.index')->with('status', [
            'type' => 'success',
            'message' => 'Dokumentum sikeresen létrehozva'
        ]);

    }

    public function showList()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('pages.document-list', compact('documents'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $document = Document::findBySlugOrFail($slug);
        $images = $document->getImages();

        return view('pages.document', compact('document', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);

        return view('admin.document-form', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DocumentRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, $id)
    {
        $document = Document::findOrFail($id);

        $extraParams = [];
        if ($request->file('file')) {
            $extraParams['file_path'] = $this->saveFile($request);
        }

        $document->update(array_merge($request->all(), $extraParams));

        return redirect('/admin/documents')->with('status', [
            'type' => 'success',
            'message' => 'Dokumentum sikeresen frissítve'
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
        Document::destroy($id);

        return redirect('/admin/documents')->with('status', [
            'type' => 'success',
            'message' => 'Dokumentum sikeresen törölve'
        ]);
    }

    protected function saveFile(DocumentRequest $request)
    {
        $file = $request->file('file');
        $filename = sprintf(
            "%s-%s.%s",
            str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)),
            uniqid(),
            $file->getClientOriginalExtension()
        );

        $file->move(public_path("uploads"), $filename);
        return "uploads/$filename";
    }
}
