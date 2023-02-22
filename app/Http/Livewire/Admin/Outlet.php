<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use App\Models\Outlet as ModelsOutlet;
use Livewire\Component;
use Livewire\WithPagination;

class Outlet extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'setOutlet', 'refreshOutlet' => '$refresh'];
    public $title;
    protected $outlet;

    public $search;
    public $total_show = 10;

    public $name;
    public $outlet_id;
    public $cabang_id;
    // public $lokasi;
    public $address;

    public $cabang;

    protected $rulesUpdate = [
        'name' => 'required',
        'cabang_id' => 'required',
        'address' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Mohon masukan nama role',
        'cabang_id.required' => 'Mohon Pilih kantor cabang',
        'address.required' => 'Mohon masukan alamat outlet',
    ];

    public function render()
    {
        $this->outlet = ModelsOutlet::where(function ($q) {
            $q->where('nama_outlet', 'LIKE', '%'.$this->search.'%')
                ->orWhere('address', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $this->cabang = Office::where('status', 1)->get();
        $data['cabang'] = $this->cabang;

        $data['outlet'] = $this->outlet;

        return view('livewire.admin.outlet', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function setOutlet($item)
    {
        $this->outlet_id = $item['id'];
        $this->name = $item['nama_outlet'];
        $this->cabang_id = $item['office_id'];
        // $this->lokasi = $item['lokasi'];
        $this->address = $item['address'];
    }

    public function resetInput()
    {
        $this->outlet_id = null;
        $this->name = null;
        $this->cabang_id = null;
        // $this->lokasi = null;
        $this->address = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'cabang_id' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Nama outlet tidak bisa kosong',
            'cabang_id.required' => 'Pilih kantor cabang',
            'address.required' => 'Alamat outlet diperlukan',
        ]);

        $save = ModelsOutlet::updateOrCreate([
            'nama_outlet' => $this->name,
            'office_id' => $this->cabang_id,
            'address' => $this->address,
        ]);

        $this->resetInput();
        $this->emit('finishOutlet', 1, 'Data Outlet berhasil disimpan!');
        $this->emit('refresh');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = ModelsOutlet::find($this->outlet_id);
        if (!$cabang) {
            return session()->flash('fail', 'Outlet tidak ditemukan');
        }

        $cabang->nama_outlet = $this->name;
        $cabang->office_id = $this->cabang_id;
        $cabang->address = $this->address;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishOutlet', 1, 'Data Outlet berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data kantor cabang!');
    }

    public function delete()
    {
        $cabang = ModelsOutlet::find($this->outlet_id);

        if (!$cabang) {
            return session()->flash('fail', 'Outlet tidak ditemukan!');
        }
        $name = $cabang->nama_outlet;

        $cabang->delete();
        $this->emit('finishCabang', 1, 'Data Outlet berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'Outlet '.$name.' Berhasil dihapus');
    }
}
