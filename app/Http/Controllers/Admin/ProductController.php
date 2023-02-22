<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $data['title'] = 'Produk';
        $data['active'] = 'produk';

        return view('admin.pages.produk', $data);
    }
}
