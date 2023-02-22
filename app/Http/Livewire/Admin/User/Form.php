<?php

namespace App\Http\Livewire\Admin\User;

use App\CPU\Helpers;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use App\Models\User_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $listeners = ['simpanForm', 'getOutlet'];

    public $name;
    public $nik;
    public $email;
    public $phone;

    public $img;
    public $photo;
    public $tempatlahir;
    public $tanggallahir;
    public $kelamin;
    public $agama;
    public $alamat;
    public $domisili;
    public $kewarganegaraan;
    public $nama_ibu;
    public $pendidikan;

    public $ktp_img;
    public $photo_ktp;
    public $no_kk;
    public $status;
    public $rekening;
    public $bank;

    public $cabang_id = '';
    public $outlet_id = '';
    public $jabatan;
    public $keterangan;
    public $role_id;
    public $is_active = 1;

    public $country;
    public $role;
    public $jab;
    public $office = [];
    public $outlet = [];
    public $nikah;
    public $bank_list;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChange');
        $this->country = Helpers::getCountry();
        $this->jab = Helpers::getJabatan();
        $this->nikah = Helpers::getStatus();
        $this->bank_list = Helpers::getBank();
        $this->office = Office::where('status', 1)->orderBy('created_at', 'desc')->get();

        return view('livewire.admin.user.form');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->nik = '';
        $this->email = '';
        $this->phone = '';

        $this->img = '';
        $this->photo = '';
        $this->tempatlahir = '';
        $this->tanggallahir = '';
        $this->kelamin = '';
        $this->agama = '';
        $this->alamat = '';
        $this->domisili = '';
        $this->kewarganegaraan = '';
        $this->nama_ibu = '';
        $this->pendidikan = '';
        $this->ktp_img = '';
        $this->photo_ktp = '';
        $this->no_kk = '';
        $this->status = '';
        $this->rekening = '';
        $this->bank = '';

        $this->cabang_id = '';
        $this->outlet_id = '';
        $this->jabatan = '';
        $this->keterangan = '';
        $this->role_id = '';
        $this->is_active = 1;
    }

    public function mount()
    {
        $this->role = Role::get();
        if ($this->cabang_id != '') {
            $this->outlet = Helpers::getOutlet($this->cabang_id);
        } else {
            $this->outlet = [];
        }
    }

    public function getOutlet()
    {
        if ($this->cabang_id != '') {
            $this->outlet = Helpers::getOutlet($this->cabang_id);
        }
    }

    public function simpanForm()
    {
        $check_email = User::where('email', $this->email)->first();
        $check_phone = User::where('phone', $this->phone)->first();

        if (isset($check_email)) {
            $message = 'Email sudah digunakan!';

            return $this->emit('finishDataUser', 0, $message);
        }
        if (isset($check_phone)) {
            $message = 'Handphone sudah digunakan!';

            return $this->emit('finishDataUser', 0, $message);
        }
        $dir = 'profile';
        $dir_ktp = 'ktp';

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'outlet_id' => $this->outlet_id,
            'password' => Hash::make(Helpers::defaultPassword()),
            'phone' => $this->phone,
            'is_active' => 1,
            'role_id' => $this->role_id,
            'nik' => $this->nik,
            'keterangan' => $this->keterangan,
        ]);

        $imgName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
        $ktpName = Carbon::now()->toDateString().'-ktp-'.uniqid().'.'.'png';
        if ($this->img) {
            $this->img->storeAs('public/'.$dir, $imgName);
        }
        $this->ktp_img->storeAs('public/'.$dir, $ktpName);

        $detail = User_detail::create([
            'img' => 'storage/profile/'.$imgName,
            'user_id' => $user->id,
            'full_name' => $user->name,
            'nik' => $user->nik,
            'tempat_lahir' => $this->tempatlahir,
            'tanggal_lahir' => $this->tanggallahir,
            'kelamin' => $this->kelamin,
            'agama' => $this->agama,
            'alamat_lengkap' => $this->alamat,
            'alamat_domisili' => $this->domisili,
            'kewarganegaraan' => $this->kewarganegaraan,
            'nama_ibu' => $this->nama_ibu,
            'pendidikan' => $this->pendidikan,
            'cabang_id' => $this->cabang_id,
            'jabatan' => $this->jabatan,
            'outlet_id' => $this->outlet_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'ktp_img' => 'storage/profile/'.$ktpName,
            'no_kk' => $this->no_kk,
            'bank' => $this->bank,
            'rekening' => $this->rekening,
            'status' => $this->status,
        ]);

        $this->resetInput();
        $this->emit('refreshUser');
        $message = 'Admin / Karyawan berhasil ditambahkan!';
        $this->emit('finishSimpanData', 1, $message);

        return session()->flash('success', 'Berhasil menambah data karyawan!');
    }
}
