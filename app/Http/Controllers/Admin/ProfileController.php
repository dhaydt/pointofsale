<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $data['title'] = 'Profil User';
        $data['active'] = 'profil';

        return view('admin.pages.profil', $data);
    }
}
