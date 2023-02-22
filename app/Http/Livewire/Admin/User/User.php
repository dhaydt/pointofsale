<?php

namespace App\Http\Livewire\Admin\User;

use App\CPU\Helpers;
use App\CPU\imageManager;
use App\Models\Role;
use App\Models\User as ModelsUser;
use App\Models\User_detail;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $paginationTheme = 'bootstrap';
    public $listeners = ['simpan', 'update', 'setDataUser', 'updateForm', 'hapus', 'refreshUser' => '$refresh'];
    public $total_show = 10;
    public $search;
    public $title;
    protected $users;

    public $name;
    public $nik;
    public $email;
    public $phone;
    public $u_id;

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

    public $cabang_id;
    public $outlet_id;
    public $jabatan;
    public $keterangan;
    public $role_id;
    public $is_active = 1;

    public $country = [];
    public $role;
    public $jab;
    public $office = [
        'o1', 'o2', 'o3',
    ];
    public $outlet = ['out1', 'out2', 'out3'];
    public $nikah;
    public $bank_list;

    public function render()
    {
        $this->users = ModelsUser::with('detail')->where('email', '!=', 'root@root.com')->where('email', '!=', 'admin@admin.com')->where(function ($query) {
            $query->where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('phone', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orWhere('nik', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);
        $data['users'] = $this->users;
        $this->country = Helpers::getCountry();
        $this->jab = Helpers::getJabatan();
        $this->nikah = Helpers::getStatus();
        $this->bank_list = Helpers::getBank();
        $this->role = Role::get();
        $data['country'] = $this->country;

        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.admin.user.user', $data);
    }

    public function updateForm()
    {
        $user = ModelsUser::with('detail')->find($this->u_id);
        $detail = User_detail::where('user_id', $this->u_id)->first();
        if (!$user) {
            $this->emit('finishDataUser', 0, 'Admin / Karyawan Tidak ditemukan!');
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
        $user->keterangan = $this->keterangan;

        if (!$detail) {
            $detail = new User_detail();
            $detail->user_id = $this->u_id;
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
        $detail->tempat_lahir = $this->tempatlahir;
        $detail->tanggal_lahir = $this->tanggallahir;
        $detail->kelamin = $this->kelamin;
        $detail->agama = $this->agama;
        $detail->alamat_lengkap = $this->alamat;
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

        $this->emit('refreshUser');
        $this->emit('finishUpdate');
        $message = 'Data Admin / Karyawan berhasil diubah';

        return session()->flash('success', $message);
    }

    public function setDataUser($id)
    {
        $user = ModelsUser::with('detail')->find($id);

        if (!$user) {
            return session()->flash('fail', 'Data tidak ditemukan!');
        }

        $this->name = $user->name;
        $this->u_id = $id;
        $this->nik = $user->nik;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->photo = $user->detail->img;
        $this->tempatlahir = $user->detail->tempat_lahir;
        $this->tanggallahir = $user->detail->tanggal_lahir;
        $this->kelamin = $user->detail->kelamin;
        $this->agama = $user->detail->agama;
        $this->alamat = $user->detail->alamat_lengkap;
        $this->domisili = $user->detail->alamat_domisili;
        $this->kewarganegaraan = $user->detail->kewarganegaraan;
        $this->nama_ibu = $user->detail->nama_ibu;
        $this->pendidikan = $user->detail->pendidikan;
        $this->photo_ktp = $user->detail->ktp_img;
        $this->no_kk = $user->detail->no_kk;
        $this->status = $user->detail->status;
        $this->rekening = $user->detail->rekening;
        $this->bank = $user->detail->bank;

        $this->cabang_id = $user->detail->cabang_id;
        $this->outlet_id = $user->detail->outlet_id;
        $this->jabatan = $user->detail->jabatan;
        $this->keterangan = $user->keterangan;
        $this->role_id = $user->role_id;
        $this->country = Helpers::getCountry();
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function hapus($id)
    {
        $user = ModelsUser::find($id);
        if (!$user) {
            $message = 'Data Admin / Karyawan tidak ditemukan';

            return session()->flash('fail', $message);
        }

        $userdetail = User_detail::where('user_id', $id)->first();

        if (isset($userdetail)) {
            $userdetail->delete();
        }

        $user->delete();
        $message = 'Data Admin / Karyawan berhasil dihapus';
        $this->emit('finishDataUser', 1, 'Data berhasil dihapus!');

        return session()->flash('success', $message);
    }
}
