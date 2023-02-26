<?php

namespace App\Http\Livewire\Admin;

use App\CPU\Helpers;
use App\CPU\imageManager;
use App\Models\User;
use App\Models\User_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profil extends Component
{

    use WithFileUploads;
    public $listeners = ['save', 'change_password', 'refreshProfile' => '$refresh'];
    public $title;

    protected $user;

    public $name;
    public $outlet_id;
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
    public $status;

    public $password;
    public $c_password;

    public $photo;
    public $photo_ktp;
    public $country;
    public $nikah;

    public function render()
    {
        $this->user_id = session()->get('user_id');

        $this->user = User::with('detail', 'role', 'outlet')->find($this->user_id);
        $user = $this->user;
        

        $this->country = Helpers::getCountry();
        $this->nikah = Helpers::getStatus();

        $data['user'] = $user;

        return view('livewire.admin.profil', $data);
    }
    public function mount($title){
        $this->title = $title;

        $this->user_id = session()->get('user_id');

        $this->user = User::with('detail', 'role', 'outlet')->find($this->user_id);
        $user = $this->user;
        $this->name = $user->name;
        $this->outlet_id = $user->outlet_id;
        $this->nik = $user->nik;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->photo = $user->detail->img ?? '';
        $this->role_id = $user->role_id;
        $this->tempat_lahir = $user->detail->tempat_lahir  ?? '';
        $this->tanggal_lahir = $user->detail->tanggal_lahir  ?? '';
        $this->kelamin = $user->detail->kelamin ?? '';
        $this->agama = $user->detail->agama ?? '';
        $this->alamat_ktp = $user->detail->alamat_lengkap ?? '';
        $this->domisili = $user->detail->alamat_domisili ?? '';
        $this->kewarganegaraan = $user->detail->kewarganegaraan ?? '';
        $this->nama_ibu = $user->detail->nama_ibu ?? '';
        $this->pendidikan = $user->detail->pendidikan ?? '';
        $this->cabang_id = $user->detail->cabang_id ?? '';
        $this->jabatan = $user->detail->jabatan ?? '';
        $this->photo_ktp = $user->detail->ktp_img ?? '';
        $this->no_kk = $user->detail->no_kk ?? '';
        $this->rekening = $user->detail->rekening ?? '';
        $this->bank = $user->detail->bank ?? '';
        $this->status = $user->detail->status ?? '';
    }

    public function change_password(){
        $this->validate([
            'password' => 'min:8|required_with:c_password|same:c_password',
            'c_password' => 'min:8'
        ], [
            'password.same' => 'Password baru dan konfirmasi password harus sama!',
            'password.min' => 'Minimal 8 karakter',
            'c_password.min' => 'Minimal 8 karakter',
            'c_password.required' => 'Mohon masukan konfirmasi password',
        ]);

        $user = User::find($this->user_id);
        if(!$user){
            $this->emit('finishProfile', 0, 'Profil Tidak ditemukan!');
        }
        $user->password = Hash::make($this->password);
        $user->save();

        $this->emit('finishPassword');

        return session()->flash('success', 'Password berhasil diubah');
    }

    public function save(){
        $user = User::find($this->user_id);
        $detail = User_detail::where('user_id', $this->user_id)->first();

        if (!$user) {
            $this->emit('finishProfile', 0, 'Profil Tidak ditemukan!');
        }

        $dir = 'profile';
        $dir_ktp = 'ktp';

        $user->name = $this->name;
        $user->email = $this->email;
        $user->outlet_id = $this->outlet_id;
        $user->phone = $this->phone;
        $user->is_active = 1;
        $user->role_id = $this->role_id;
        $user->nik = $this->nik;

        if (!$detail) {
            $detail = new User_detail();
            $detail->user_id = $this->user_id;
        }

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            imageManager::delete($user->detail->img);
            $this->img->storeAs('public/'.$dir, $imageName);
            $detail->img = 'storage/profile/'.$imageName;
        }
        if ($this->ktp_img != null) {
            $ktpName = Carbon::now()->toDateString().'-ktp-'.uniqid().'.'.'png';
            imageManager::delete($user->detail->ktp_img);
            $this->img->storeAs('public/'.$dir_ktp, $ktpName);
            $detail->ktp_img = 'storage/ktp/'.$ktpName;
        }

        $detail->full_name = $user->name;
        $detail->nik = $user->nik;
        $detail->tempat_lahir = $this->tempat_lahir;
        $detail->tanggal_lahir = $this->tanggal_lahir;
        $detail->kelamin = $this->kelamin;
        $detail->agama = $this->agama;
        $detail->alamat_lengkap = $this->alamat_ktp;
        $detail->alamat_domisili = $this->domisili;
        $detail->kewarganegaraan = $this->kewarganegaraan;
        $detail->nama_ibu = $this->nama_ibu;
        $detail->pendidikan = $this->pendidikan;
        $detail->cabang_id = $this->cabang_id;
        $detail->jabatan = $this->jabatan;
        $detail->outlet_id = $this->outlet_id;
        $detail->phone = $this->phone;
        $detail->email = $this->email;
        $detail->no_kk = $this->no_kk;
        $detail->bank = $this->bank;
        $detail->rekening = $this->rekening;
        $detail->status = $this->status;
        $user->save();
        $detail->save();

        $this->emit('refreshProfile');
        $this->emit('finishProfile');
        $message = 'Profil berhasil diubah';

        return session()->flash('success', $message);
    }
}
