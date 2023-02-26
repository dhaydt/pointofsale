<?php

namespace App\Http\Controllers\Api;

use App\CPU\CryptHelpers;
use App\CPU\Helpers;
use App\CPU\imageManager;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileControlller extends Controller
{
    public function index(Request $request){
        $user = CryptHelpers::getAuthApi($request);

        // return $user;

        $detail = User_detail::where('user_id', $user->id)->first();
        if(!$detail){
            $detail = new User_detail();
            $detail->user_id = $user->id;
            $detail->save();

            $user = User::with('detail')->find($user->id);
        }

        $data = [
            'cabang_id' => $user->detail->cabang_id ?? 'Belum di isi',
            'outlet_id' => $user->outlet_id,
            'nama_outlet' => $user->outlet->nama_outlet ?? 'Belum di isi',
            'name' => $user->name,
            'profile_img' => $user->detail->img ?? 'Belum di isi',
            'ktp_img' => $user->detail->ktp ?? 'Belum di isi',
            'phone' => $user->phone,
            'email' => $user->email,
            'nik' => $user->nik,
            'no_kk' => $user->detail->no_kk ?? 'Belum di isi',
            'tempat_lahir' => $user->detail->tempat_lahir ?? 'Belum di isi',
            'tanggal_lahir' => $user->detail->tanggal_lahir ?? 'Belum di isi',
            'kelamin' => $user->detail->kelamin ?? 'Belum di isi',
            'agama' => $user->detail->agama ?? 'Belum di isi',
            'alamat_ktp' => $user->detail->alamat_lengkap ?? 'Belum di isi',
            'domisili' => $user->detail->alamat_domisili ?? 'Belum di isi',
            'kewarganegaraan' => $user->detail->kewarganegaraan ?? 'Belum di isi',
            'nama_ibu' => $user->detail->nama_ibu ?? 'Belum di isi',
            'pendidikan' => $user->detail->pendidikan ?? 'Belum di isi',
            'jabatan' => $user->detail->jabatan ?? 'Belum di isi',
            'rekening' => $user->detail->rekening ?? 'Belum di isi',
            'bank' => $user->detail->bank ?? 'Belum di isi',
            'status_pernikahan' => $user->detail->status ?? 'Belum di isi',
        ];

        return response()->json(['status' => 'success','data' => $data]);
    }

    public function update_password(Request $request){
        $request->validate([
            "password" => 'min:8',
        ]);

        $id = CryptHelpers::getAuthApi($request)['id'];

        $user = User::with('detail')->find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(Helpers::responseApi('success', 'Password changed successfully'));
    }

    public function update(Request $request){
        $request->validate([
            "phone" => 'required',
            "tanggal_lahir" => 'required',
            "nama_ibu" => 'required',
            "pendidikan" => 'required',
            "name" => 'required',
            "jabatan" => 'required',
        ]);

        $id = CryptHelpers::getAuthApi($request)['id'];

        $user = User::with('detail')->find($id);
        $detail = User_detail::where('user_id', $user->id)->first();

        $dir = 'profile';

        $user->name = $request->name;
        // $user->email = $request->email;
        // $user->outlet_id = $request->outlet_id;
        $user->phone = $request->phone;
        // $user->role_id = $request->role_id;
        // $user->nik = $request->nik;

        if ($request->has('profile_img')) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            imageManager::delete($detail->img);
            $request->profile_img->storeAs('public/'.$dir, $imageName);
            $detail->img = 'storage/profile/'.$imageName;
        }

        $detail->full_name = $request->name;
        // $detail->nik = $user->nik;
        $detail->tempat_lahir = $request->tempat_lahir;
        $detail->tanggal_lahir = $request->tanggal_lahir;
        $detail->kelamin = $request->kelamin;
        $detail->agama = $request->agama;
        $detail->alamat_lengkap = $request->alamat_ktp;
        $detail->alamat_domisili = $request->domisili;
        $detail->kewarganegaraan = $request->kewarganegaraan;
        $detail->nama_ibu = $request->nama_ibu;
        $detail->pendidikan = $request->pendidikan;
        $detail->cabang_id = $request->cabang_id;
        $detail->jabatan = $request->jabatan;
        // $detail->outlet_id = $request->outlet_id;
        // $detail->phone = $request->phone;
        // $detail->email = $request->email;
        // $detail->no_kk = $request->no_kk;
        $detail->bank = $request->bank;
        $detail->rekening = $request->rekening;
        $detail->status = $request->status_pernikahan;
        $user->save();
        $detail->save();

        return response()->json(Helpers::responseApi('success', 'Profile updated successfully'));
    }
}
