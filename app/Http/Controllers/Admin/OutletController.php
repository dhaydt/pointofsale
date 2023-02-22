<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OutletController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Outlet';
        $data['active'] = 'outlet';

        return view('admin.pages.outlet', $data);
    }
}
