<?php

namespace App\Http\Controllers\Api;

use App\CPU\CryptHelpers;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function history(Request $request){
        $user = CryptHelpers::getAuthApi($request);

        $absen = Absen::with('users', 'outlet')->select('id', 'user_id', 'outlet_id', 'shift', 'time', 'type', 'location')->where(['user_id' => $user['id'], 'outlet_id' => $user['outlet_id']])->orderBy('created_at', 'desc')->get();

        return response()->json(['status' => 'success', 'data' => $absen]);
    }
    public function clock_check(Request $request){
        $request->validate([
            "shift" => 'required',
            "type" => 'required',
            "time" => 'required',
            "location" => 'required',
        ], [
            'shift.required' => 'Pilih shift masuk!',
            'type.required' => 'Pilih tipe absen! (Masuk atau Pulang)',
            'time.required' => 'Masukan jam absen!',
            'location.required' => 'Masukan lokasi absen!',
        ]);

        $user = CryptHelpers::getAuthApi($request);

        $jam_masuk = $request->time;
        $lokasi_masuk = $request->time;
        $jam_pulang= $request->time;
        $jam_masuk = $request->time;

        $outlet = $user['detail'];
        if($outlet){
            $outlet = $user['detail']['outlet_id'];
        }else{
            $outlet = 'Invalid outlet';
        }

        
        Absen::create([
            'user_id' => $user['id'],
            'outlet_id' => $outlet,
            'shift' => $request->shift,
            'type' => $request->type,
            'time' => $request->time,
            'location' => $request->location
        ]);

        return response()->json(Helpers::responseApi('success', 'Absen '.$request->type.' berhasil diambil'));
        
    }
}
