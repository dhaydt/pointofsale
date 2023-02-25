<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Profil extends Component
{

    public $listeners = ['save'];
    public $title;

    protected $user;

    public $name;
    public $outlet_id;
    public $password;
    public $nik;
    public $phone;
    public $role_id;
    public $email;
    public $img;
    public $user_id;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $kelamin;
    public $agama;
    public $alamat_ktp;
    public $domisili;
    public $kewarganegaraan;
    public $nama_ibu;
    public $pendidikan;
    public $cabang_id;
    public $jabatan;
    public $ktp_img;
    public $no_kk;
    public $rekening;
    public $bank;

    public $photo;
    public $photo_ktp;

    public function render()
    {
        $this->user = User::with('detail', 'role', 'outlet')->find(session()->get('user_id'));
        $user = $this->user;
        $this->name = $user->name;
        $this->outlet_id = $user->outlet_id;
        $this->nik = $user->nik;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->photo = $user->detail->img;
        $this->user_id = $user->id;
        $this->role_id = $user->role_id;
        $this->tempat_lahir = $user->detail->tempat_lahir;
        $this->tanggal_lahir = $user->detail->tanggal_lahir;
        $this->kelamin = $user->detail->kelamin;
        $this->agama = $user->detail->agama;
        $this->alamat_ktp = $user->detail->alamat_lengkap;
        $this->domisili = $user->detail->alamat_domisili;
        $this->kewarganegaraan = $user->detail->kewarganegaraan;
        $this->nama_ibu = $user->detail->nama_ibu;
        $this->pendidikan = $user->detail->pendidikan;
        $this->cabang_id = $user->detail->cabang_id;
        $this->jabatan = $user->detail->jabatan;
        $this->photo_ktp = $user->detail->ktp_img;
        $this->no_kk = $user->detail->no_kk;
        $this->rekening = $user->detail->rekening;
        $this->bank = $user->detail->bank;

        $data['user'] = $user;

        return view('livewire.admin.profil', $data);
    }
    public function mount($title){
        $this->title = $title;
    }
}
