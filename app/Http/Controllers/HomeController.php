<?php
/**
 * (c) 2016. 10. 13..
 * Authors: nxu
 */

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function adminIndex()
    {
        return redirect('/admin/news');
    }
}
