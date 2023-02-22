<?php

namespace App\Http\Livewire\Admin;

use App\CPU\imageManager;
use App\Models\Category;
use App\Models\Jasa as ModelsJasa;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Jasa extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'updateJasa', 'refreshJasa' => '$refresh'];
    public $title;
    protected $jasa;

    public $search;
    public $total_show = 10;

    public $name;
    public $img;
    public $price;
    public $jasa_id;
    public $cat_id;
    public $description;

    public $photo;
    public $category;

    protected $rulesUpdate = [
        'cat_id' => 'required',
        'name' => 'required',
        'price' => 'required',
    ];

    protected $messages = [
        'cat_id.required' => 'Mohon pilih kategori jasa',
        'name.required' => 'Mohon masukan nama jasa',
        'price.required' => 'Mohon masukan harga jasa',
    ];

    public function render()
    {
        $this->jasa = ModelsJasa::where(function ($q) {
            $q->where('name', 'LIKE', '%'.$this->search.'%')
                ->where('description', 'LIKE', '%'.$this->search.'%');
        })->orWhereHas('category', function ($c) {
            $c->where('name', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['jasa'] = $this->jasa;

        return view('livewire.admin.jasa', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
        $this->category = Category::get();
    }

    public function updateJasa($item)
    {
        $item = json_decode($item);
        $this->jasa_id = $item->id;
        $this->cat_id = $item->category_id;
        $this->name = $item->name;
        $this->photo = $item->image;
        $this->price = $item->price;
        $this->description = $item->description;
    }

    public function resetInput()
    {
        $this->jasa_id = null;
        $this->cat_id = null;
        $this->name = null;
        $this->img = null;
        $this->price = null;
        $this->description = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'cat_id' => 'required',
            'img' => 'required',
            'price' => 'required',
        ], [
            'name.required' => 'Mohon masukan nama jasa',
            'cat_id.required' => 'Mohon pilih kategori jasa',
            'img.required' => 'Mohon masukan foto jasa',
            'price.required' => 'Mohon masukan harga jasa',
        ]);

        $dir = 'jasa';

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            $this->img->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/jasa/'.$imageName;
        }

        $save = ModelsJasa::updateOrCreate([
            'name' => $this->name,
            'category_id' => $this->cat_id,
            'image' => isset($img_name) ? $img_name : null,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->resetInput();
        $this->emit('finishJasa', 1, 'Data jasa berhasil disimpan!');
        $this->emit('refresh');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = ModelsJasa::find($this->jasa_id);
        if (!$cabang) {
            return session()->flash('fail', 'jasa tidak ditemukan');
        }

        $dir = 'jasa';

        $img_name = null;

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            imageManager::delete($cabang->image);
            $this->img->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/jasa/'.$imageName;
            $cabang->image = $img_name;
        }

        $cabang->name = $this->name;
        $cabang->category_id = $this->cat_id;
        $cabang->price = $this->price;
        $cabang->description = $this->description;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishJasa', 1, 'Data jasa berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data jasa!');
    }

    public function delete()
    {
        $cabang = ModelsJasa::find($this->prod_id);

        if (!$cabang) {
            return session()->flash('fail', 'jasa tidak ditemukan!');
        }
        imageManager::delete($cabang->image);
        $name = $cabang->name;

        $cabang->delete();
        $this->emit('finishJasa', 1, 'Data jasa berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'jasa '.$name.' Berhasil dihapus');
    }
}
