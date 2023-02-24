<?php

namespace App\Http\Controllers\Api\Auth;

use App\CPU\CryptHelpers;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\LoginLogs;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutentikasiController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email Tidak bisa kosong',
            'password.required' => 'Password tidak bisa kosong',
            'password.min:8' => 'Minimal password 8 huruf!',
        ]);

        $user = User::with('detail')->where('email', $data['email'])->first();
        dd($user);
        if (!$user) {

            return response()->json(Helpers::responseApi('fail', 'Email tidak ditemukan'));
        } else {
            if (!Hash::check($data['password'], $user->password)) {
                return response()->json(Helpers::responseApi('fail', 'Password salah'));
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

            // $request->session()->put('user_id', $loginLogs->user_id);
            // $request->session()->put('token', $loginLogs->token);
            // $request->session()->put('user_log_id', $user_logs->id);

            $dataUser = [
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'nik' => $user['nik'],
                'outlet' => $user['outlet']['nama_outlet'] ?? 'Invalid data outlet',
            ];

            return response()->json(['status' => 'success', 'data' => $dataUser, 'token' => $loginLogs->token]);
        }
    }
}
