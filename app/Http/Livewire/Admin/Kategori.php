<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Kategori extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'changeKategori', 'refreshKategori' => '$refresh'];
    public $title;
    protected $kategori;

    public $search;
    public $total_show = 10;

    public $name;
    public $cat_id;

    protected $rulesUpdate = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Mohon masukan nama kategori',
    ];

    public function render()
    {
        $this->kategori = Category::where(function ($q) {
            $q->where('name', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['kategori'] = $this->kategori;

        return view('livewire.admin.kategori', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function changeKategori($item)
    {
        $item = json_decode($item);
        $this->cat_id = $item->id;
        $this->name = $item->name;
    }

    public function resetInput()
    {
        $this->cat_id = null;
        $this->name = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama kategori tidak bisa kosong',
        ]);

        $save = Category::updateOrCreate([
            'name' => $this->name,
        ]);

        $this->resetInput();
        $this->emit('finishKategori', 1, 'Data kategori berhasil disimpan!');
        $this->emit('refresh');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = Category::find($this->cat_id);
        if (!$cabang) {
            return session()->flash('fail', 'kategori tidak ditemukan');
        }

        $cabang->name = $this->name;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishKategori', 1, 'Data kategori berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data kategori!');
    }

    public function delete()
    {
        $cabang = Category::find($this->cat_id);

        if (!$cabang) {
            return session()->flash('fail', 'kategori tidak ditemukan!');
        }
        $name = $cabang->name;

        $cabang->delete();
        $this->emit('finishKategori', 1, 'Data kategori berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'kategori '.$name.' Berhasil dihapus');
    }
}
