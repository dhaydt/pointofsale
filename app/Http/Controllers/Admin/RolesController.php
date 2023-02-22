<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        $data['title'] = 'Hak Akses';
        $data['active'] = 'roles';

        return view('admin.pages.roles', $data);
    }
}
