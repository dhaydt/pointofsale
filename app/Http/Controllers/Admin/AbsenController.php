<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $data['title'] = 'Absen Karyawan';
        $data['active'] = 'absen';

        return view('admin.pages.absen', $data);
    }
}
