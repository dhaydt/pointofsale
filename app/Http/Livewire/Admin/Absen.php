<?php

namespace App\Http\Livewire\Admin;

use App\Models\Absen as ModelsAbsen;
use Livewire\Component;
use Livewire\WithPagination;

class Absen extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update','delete', 'setAbsen', 'updateAbsen', 'refreshAbsen' => '%refresh' ];

    protected $absen;

    public $title;

    public $search;
    public $total_show = 10;

    public $user_id;
    public $absen_id;
    public $outlet_id;
    public $shift;
    public $time;
    public $location;
    public $type;

    protected $rules = [
        'user_id' => 'required',
        'outlet_id' => 'required',
        'shift' => 'required',
        'time' => 'required',
        'location' => 'required',
        'type' => 'required'
    ];
    
    protected $messages = [
        'user_id.required' => 'Pilih karyawan',
        'outlet_id' => 'pilih outlet',
        'shift' => 'pilih shift',
        'type' => 'Select type',
        'time' => 'Waktu absen diperlukan',
        'location' => 'lokasi absen diperlukan'
    ];

    public function render()
    {
        // $user = ModelsAbsen::with('user')->get();
        // dd($user);
        $this->absen = ModelsAbsen::with('users', 'outlet')->whereHas('users', function($q){
            $q->where('name', 'LIKE', '%'.$this->search.'%')
            ->orwhere('email', 'LIKE', '%'.$this->search.'%')
            ->orwhere('phone', 'LIKE', '%'.$this->search.'%')
            ->orwhere('nik', 'LIKE', '%'.$this->search.'%');
        })->orWhereHas('outlet', function($o){
            $o->where('nama_outlet', 'LIKE', '%'.$this->search.'%')
            ->orWhere('lokasi', 'LIKE', '%'.$this->search.'%')
            ->orWhere('address', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['absen'] = $this->absen;

        return view('livewire.admin.absen', $data);
    }

    public function mount($title){
        $this->title = $title;
    }

    public function delete()
    {
        $cabang = ModelsAbsen::find($this->absen_id);

        if (!$cabang) {
            return session()->flash('fail', 'Data absen tidak ditemukan!');
        }
        // $name = $cabang->nama_cabang;

        $cabang->delete();
        $this->emit('finishAbsen', 1, 'Data Abse berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'Data Absen Berhasil dihapus');
    }
}
