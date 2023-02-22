<?php

namespace App\Http\Livewire\Admin;

use App\CPU\imageManager;
use App\Models\Office;
use App\Models\Outlet;
use App\Models\Payroll as ModelsPayroll;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Payroll extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'setPayroll', 'refreshPayroll' => '$refresh'];
    public $title;
    protected $payroll;

    public $search;
    public $total_show = 10;

    public $user_id;
    public $payroll_id;
    public $cabang_id;
    public $outlet_id;
    public $bulan;
    public $tahun;
    public $gaji;
    public $img;

    public $photo;
    public $cabang = [];
    public $outlet = [];
    public $user = [];

    protected $rulesUpdate = [
        'user_id' => 'required',
        'outlet_id' => 'required',
        'bulan' => 'required',
        'tahun' => 'required',
        'gaji' => 'required',
    ];

    protected $messages = [
        'user_id.required' => 'Mohon pilih karyawan',
        'outlet_id.required' => 'Mohon Pilih kantor cabang',
        'bulan.required' => 'Mohon masukan bulan gaji',
        'tahun.required' => 'Mohon masukan tahun gaji',
        'gaji.required' => 'Mohon masukan jumlah gaji',
    ];

    public function render()
    {
        $this->payroll = ModelsPayroll::where(function ($q) {
            $q->where('user_id', 'LIKE', '%'.$this->search.'%')
                ->orWhere('outlet_id', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $this->cabang = Office::where('status', 1)->get();
        $data['cabang'] = $this->cabang;

        $data['payroll'] = $this->payroll;

        return view('livewire.admin.payroll', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
        $this->user = User::where('email', '!=', 'root@root.com')->get();
        $this->cabang = Office::where('status', 1)->get();
    }

    public function getOutlet()
    {
        $this->outlet = Outlet::where('office_id', $this->cabang_id)->get();
    }

    public function setPayroll($item)
    {
        $cabang = Outlet::find($item['outlet_id']);
        $this->outlet = Outlet::where('office_id', $cabang->office_id)->get();
        $this->payroll_id = $item['id'];
        $this->user_id = $item['user_id'];
        $this->outlet_id = $item['outlet_id'];
        $this->cabang_id = $cabang->office_id;
        $this->tahun = $item['tahun'];
        $this->bulan = $item['bulan'];
        $this->gaji = $item['gaji'];
        $this->photo = $item['slip_gaji'];
    }

    public function resetInput()
    {
        $this->payroll_id = null;
        $this->user_id = null;
        $this->cabang_id = null;
        $this->outlet_id = null;
        $this->tahun = null;
        $this->bulan = null;
        $this->gaji = null;
        $this->img = null;
        $this->photo = null;
    }

    public function save()
    {
        $this->validate([
            'user_id' => 'required',
            'outlet_id' => 'required',
            'bulan' => 'required',
            'gaji' => 'required',
            'img' => 'required',
        ], [
            'user_id.required' => 'Mohon pilih karyawan',
            'outlet_id.required' => 'Mohon Pilih outlet',
            'bulan.required' => 'Mohon pilih bulan & tahun gaji',
            'gaji.required' => 'Mohon masukan nominal gaji',
            'img.required' => 'Mohon upload slip gaji',
        ]);

        $dir = 'slip';

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            $this->img->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/slip/'.$imageName;
        }

        $date = Carbon::parse('01-'.$this->bulan);
        $month = $date->format('m');
        $year = $date->format('Y');

        $save = Modelspayroll::create([
            'user_id' => $this->user_id,
            'outlet_id' => $this->outlet_id,
            'bulan' => $month,
            'tahun' => $year,
            'gaji' => $this->gaji,
            'slip_gaji' => $img_name,
        ]);

        $this->resetInput();
        $this->emit('finishPayroll', 1, 'Data payroll berhasil disimpan!');
        $this->emit('refresh');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = Modelspayroll::find($this->payroll_id);
        if (!$cabang) {
            return session()->flash('fail', 'payroll tidak ditemukan');
        }

        $dir = 'slip';

        $img_name = null;

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            imageManager::delete($cabang->image);
            $this->img->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/slip/'.$imageName;
            $cabang->slip_gaji = $img_name;
        }

        $cabang->user_id = $this->user_id;
        $cabang->outlet_id = $this->outlet_id;
        $cabang->bulan = $this->bulan;
        $cabang->tahun = $this->tahun;
        $cabang->gaji = $this->gaji;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishPayroll', 1, 'Data payroll berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data kantor cabang!');
    }

    public function delete()
    {
        $cabang = Modelspayroll::find($this->payroll_id);

        if (!$cabang) {
            return session()->flash('fail', 'payroll tidak ditemukan!');
        }
        $name = $cabang->nama_payroll;

        $cabang->delete();
        $this->emit('finishPayroll', 1, 'Data payroll berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'payroll '.$name.' Berhasil dihapus');
    }
}
