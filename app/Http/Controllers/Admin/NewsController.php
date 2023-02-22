<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $data['title'] = 'Berita';
        $data['active'] = 'News';

        return view('admin.pages.news', $data);
    }
}
