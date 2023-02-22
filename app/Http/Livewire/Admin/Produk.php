<?php

namespace App\Http\Livewire\Admin;

use App\CPU\imageManager;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Produk extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'updateProduk', 'refreshProduk' => '$refresh'];
    public $title;
    protected $produk;

    public $search;
    public $total_show = 10;

    public $name;
    public $img;
    public $price;
    public $category_id;
    public $stock;
    public $prod_id;
    public $description;

    public $photo;
    public $kategori;

    protected $rulesUpdate = [
        'category_id' => 'required',
        'name' => 'required',
        'price' => 'required',
        'stock' => 'required',
    ];

    protected $messages = [
        'category_id.required' => 'Mohon pilih kategori produk',
        'name.required' => 'Mohon masukan nama produk',
        'price.required' => 'Mohon masukan harga produk',
        'stock.required' => 'Mohon masukan jumlah produk',
    ];

    public function render()
    {
        $this->produk = Product::where(function ($q) {
            $q->where('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('description', 'LIKE', '%'.$this->search.'%');
        })->orWhereHas('category', function ($c) {
            $c->where('name', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['produk'] = $this->produk;

        return view('livewire.admin.produk', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
        $this->kategori = Category::get();
    }

    public function updateProduk($item)
    {
        $item = json_decode($item);
        $this->prod_id = $item->id;
        $this->category_id = $item->category_id;
        $this->name = $item->name;
        $this->photo = $item->image;
        $this->price = $item->price;
        $this->stock = $item->stock;
        $this->description = $item->description;
    }

    public function resetInput()
    {
        $this->prod_id = null;
        $this->category_id = null;
        $this->name = null;
        $this->img = null;
        $this->price = null;
        $this->stock = null;
        $this->description = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'img' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ], [
            'name.required' => 'Mohon masukan nama produk',
            'category_id.required' => 'Mohon pilih kategori produk',
            'img.required' => 'Mohon masukan foto produk',
            'price.required' => 'Mohon masukan harga produk',
            'stock.required' => 'Mohon masukan jumlah produk',
        ]);

        $dir = 'product';

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            $this->img->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/product/'.$imageName;
        }

        $save = Product::updateOrCreate([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'image' => isset($img_name) ? $img_name : null,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
        ]);

        $this->resetInput();
        $this->emit('finishProduk', 1, 'Data produk berhasil disimpan!');
        $this->emit('refresh');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = Product::find($this->prod_id);
        if (!$cabang) {
            return session()->flash('fail', 'produk tidak ditemukan');
        }

        $dir = 'product';

        $img_name = null;

        if ($this->img != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            imageManager::delete($cabang->image);
            $this->img->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/product/'.$imageName;
            $cabang->image = $img_name;
        }

        $cabang->name = $this->name;
        $cabang->category_id = $this->category_id;
        $cabang->price = $this->price;
        $cabang->stock = $this->stock;
        $cabang->description = $this->description;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishProduk', 1, 'Data produk berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data produk!');
    }

    public function delete()
    {
        $cabang = Product::find($this->prod_id);

        if (!$cabang) {
            return session()->flash('fail', 'produk tidak ditemukan!');
        }
        imageManager::delete($cabang->image);
        $name = $cabang->name;

        $cabang->delete();
        $this->emit('finishProduk', 1, 'Data produk berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'produk '.$name.' Berhasil dihapus');
    }
}
