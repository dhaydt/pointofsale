<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    public function index()
    {
        $data['title'] = 'Payroll';
        $data['active'] = 'payroll';

        return view('admin.pages.payroll', $data);
    }
}
