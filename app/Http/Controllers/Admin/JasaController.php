<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class JasaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Jasa';
        $data['active'] = 'jasa';

        return view('admin.pages.jasa', $data);
    }
}
