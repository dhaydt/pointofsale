<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['active'] = 'dashboard';

        return view('admin.pages.dashboard', $data)->with('Success', 'Welcome to Admin Dashboard');
    }
}
