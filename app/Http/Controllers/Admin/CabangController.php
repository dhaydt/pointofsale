<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CabangController extends Controller
{
    public function index()
    {
        $data['title'] = 'Kantor Cabang';
        $data['active'] = 'cabang';

        return view('admin.pages.cabang', $data);
    }
}
