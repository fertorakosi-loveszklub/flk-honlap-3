<?php

namespace App\Http\Controllers\Api;

use App\Page;

class PageController
{
    public function showAbout()
    {
        return Page::where('slug', 'rolunk')->firstOrFail();
    }
}
