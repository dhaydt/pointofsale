<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use Livewire\Component;
use Livewire\WithPagination;

class Cabang extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'setKantorCabang', 'refreshCabang' => '$refresh'];
    protected $cabang;

    public $search;
    public $total_show = 10;

    public $name;
    public $cabang_id;
    public $phone;
    public $title;
    public $email;
    public $address;
    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'address' => 'required',
    ];

    protected $rulesUpdate = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'address' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Mohon masukan nama kantor cabang',
        'phone.required' => 'Mohon masukan nomor telepon',
        'email.required' => 'Mohon masukan Email',
        'address.required' => 'Mohon masukan alamat kantor cabang',
    ];

    public function render()
    {
        $this->cabang = Office::where(function ($q) {
            $q->where('nama_office', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('phone', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('address', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['cabang'] = $this->cabang;

        $this->dispatchBrowserEvent('contentChange');

        return view('livewire.admin.cabang', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function setKantorCabang($item)
    {
        $this->cabang_id = $item['id'];
        $this->name = $item['nama_office'];
        $this->phone = $item['phone'];
        $this->email = $item['email'];
        $this->address = $item['address'];
    }

    public function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->email = null;
        $this->address = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|unique:offices',
            'email' => 'required|unique:offices',
            'address' => 'required',
        ], [
            'name.required' => 'Nama kantor cabang tidak boleh kosong',
            'phone.required' => 'Masukan nomor telepon!',
            'phone.unique' => 'Nomor telepon sudah digunakan!',
            'email.unique' => 'Email sudah digunakan!',
            'email.required' => 'Masukan email!',
            'address.required' => 'Masukan alamat!',
        ]);

        $cabang = new Office();
        $cabang->nama_office = $this->name;
        $cabang->phone = $this->phone;
        $cabang->email = $this->email;
        $cabang->address = $this->address;
        $cabang->save();

        $this->resetInput();
        $this->emit('finishCabang', 1, 'Data Cabang berhasil disimpan!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil menambah data kantor cabang');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = Office::find($this->cabang_id);
        if (!$cabang) {
            return session()->flash('fail', 'Kantor cabang tidak ditemukan');
        }

        $cabang->nama_office = $this->name;
        $cabang->phone = $this->phone;
        $cabang->email = $this->email;
        $cabang->address = $this->address;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishCabang', 1, 'Data Cabang berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data kantor cabang!');
    }

    public function delete()
    {
        $cabang = Office::find($this->cabang_id);

        if (!$cabang) {
            return session()->flash('fail', 'kantor cabang tidak ditemukan!');
        }
        $name = $cabang->nama_cabang;

        $cabang->delete();
        $this->emit('finishCabang', 1, 'Data Cabang berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'Kantor cabang '.$name.' Berhasil dihapus');
    }
}
