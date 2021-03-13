<?php

namespace App\Http\Controllers\Api;

use App\Document;

class DocumentController
{
    public function index()
    {
        return Document::latest()->limit(50)->get();
    }
}
