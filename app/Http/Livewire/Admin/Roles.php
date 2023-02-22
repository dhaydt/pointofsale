<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'setDataRole', 'refreshRoles' => '$refresh'];
    protected $role;

    public $search;
    public $total_show = 10;

    public $name;
    public $role_id;
    public $hak_akses = [];
    public $title;
    public $list_hak = [
        'master', 'absen', 'submission', 'produk/jasa', 'sales', 'news', 'payroll', 'setting',
    ];
    protected $rules = [
        'name' => 'required',
        'hak_akses' => 'required',
    ];

    protected $rulesUpdate = [
        'name' => 'required',
        'hak_akses' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Mohon masukan nama role',
        'hak_akses.required' => 'Mohon masukan hak akses role',
    ];

    public function render()
    {
        $this->role = Role::where(function ($q) {
            $q->where('role', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('hak_akses', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['role'] = $this->role;

        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.admin.roles', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function resetInput()
    {
        $this->name = null;
        $this->hak_akses = [];
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'hak_akses' => 'required',
        ], [
            'name.required' => 'Nama Metode Pembayaran tidak boleh kosong',
            'hak_akses.required' => 'Pilih hak akses!',
        ]);

        $role = new Role();
        $role->role = $this->name;
        $role->hak_akses = json_encode($this->hak_akses);
        $role->save();

        $this->resetInput();
        $this->emit('finishRoles', 1, 'Data Hak Akses berhasil disimpan!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil menambah data Hak Akses baru');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = Role::find($this->role_id);
        if (!$cabang) {
            return session()->flash('fail', 'Hak Akses tidak ditemukan');
        }

        $cabang->role = $this->name;
        $cabang->hak_akses = json_encode($this->hak_akses);

        $cabang->save();

        $this->resetInput();
        $this->emit('finishRoles', 1, 'Data Hak Akses berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data karyawan!');
    }

    public function setDataRole($item)
    {
        $this->role_id = $item['id'];
        $this->name = $item['role'];
        $hak = json_decode($item['hak_akses']);
        $this->hak_akses = [];
        foreach ($hak as $h) {
            array_push($this->hak_akses, $h);
        }
    }

    public function delete()
    {
        $cabang = Role::find($this->role_id);

        if (!$cabang) {
            return session()->flash('fail', 'Role tidak ditemukan');
        }
        $name = $cabang->role;

        $cabang->delete();
        $this->emit('finishRoles', 1, 'Data Hak Akses berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'Role '.$name.' Berhasil dihapus');
    }
}
