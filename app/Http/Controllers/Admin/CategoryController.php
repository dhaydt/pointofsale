<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data['title'] = 'Kategori Produk';
        $data['active'] = 'kategori';

        return view('admin.pages.kategori', $data);
    }
}
