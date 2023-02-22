<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data['title'] = 'Admin & Karyawan';
        $data['active'] = 'admin';

        return view('admin.pages.admin', $data);
    }

    public function detail()
    {
        $data['title'] = 'Detail Admin/Karyawan';
        $data['active'] = 'detail';

        return view('admin.pages.admin', $data);
    }
}
