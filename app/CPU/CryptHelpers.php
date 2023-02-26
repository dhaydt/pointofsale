<?php

namespace App\CPU;

use App\Models\LoginLogs;
use App\Models\User;

class CryptHelpers
{
    public static function cryptToken($string, $action = 'e')
    {
        $secret_key = 'amarlawyerclubss';

        $secret_iv = '4m4rl4wy312Club5';

        $output = false;

        $encrypt_method = 'AES-128-CBC';

        $iv = substr($secret_iv, 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $secret_key, 0, $iv));
        } elseif ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $secret_key, 0, $iv);
        }

        return $output;
    }

    public static function getAuthApi($request){
        $token = explode(' ', $request->header('authorization'));
        $user_id = LoginLogs::where('token', $token[1])
            ->where('is_active', 1)->first()['user_id'];

        $user = User::with('detail', 'outlet')->find($user_id);

        return $user;
    }
}
