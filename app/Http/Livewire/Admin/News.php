<?php

namespace App\Http\Livewire\Admin;

use App\CPU\imageManager;
use App\Models\news as ModelsNews;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class News extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $paginationTheme = 'bootstrap';
    public $listeners = ['save', 'update', 'delete', 'updateNews', 'refreshNews' => '$refresh'];
    public $title;
    protected $news;

    public $search;
    public $total_show = 10;

    public $img;
    public $price;
    public $news_id;
    public $news_title;
    public $subtitle;
    public $description;
    public $link;
    public $date;
    public $image;

    public $photo;

    protected $rulesUpdate = [
        'news_title' => 'required',
        'subtitle' => 'required',
        'description' => 'required',
        'link' => 'required',
        'date' => 'required',
    ];

    protected $messages = [
        'news_title.required' => 'Mohon masukan judul berita',
        'subtitle.required' => 'Mohon masukan sub judul berita',
        'description.required' => 'Mohon masukan isi berita',
        'date.required' => 'Mohon pilih tanggal berita',
    ];

    public function render()
    {
        $this->news = ModelsNews::where(function ($q) {
            $q->where('title', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('subtitle', 'LIKE', '%'.$this->search.'%');
        })->paginate($this->total_show);

        $data['news'] = $this->news;

        return view('livewire.admin.news', $data);
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function updateNews($item)
    {
        $item = json_decode($item);
        $this->news_id = $item->id;
        $this->news_title = $item->title;
        $this->subtitle = $item->subtitle;
        $this->photo= $item->banner;
        $this->date = $item->date;
        $this->description = $item->description;
        $this->link = $item->link;
    }

    public function resetInput()
    {
        $this->news_id = null;
        $this->news_title = null;
        $this->subtitle = null;
        $this->photo= null;
        $this->date = null;
        $this->description = null;
        $this->link = null;
    }

    public function save()
    {
        $this->validate([
            'news_title' => 'required',
            'subtitle' => 'required',
            'date' => 'required',
            'description' => 'required',
        ], [
            'news_title.required' => 'Mohon masukan judul berita',
            'subtitle.required' => 'Mohon masukan sub judul berita',
            'date.required' => 'Mohon masukan tanggal berita',
            'description.required' => 'Mohon masukan isi berita',
        ]);

        $dir = 'news';

        if ($this->image != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            $this->image->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/news/'.$imageName;
        }

        $save = Modelsnews::updateOrCreate([
            'title' => $this->news_title,
            'subtitle' => $this->subtitle,
            'banner' => isset($img_name) ? $img_name : null,
            'date' => $this->date,
            'description' => $this->description,
            'link' => $this->link,
        ]);

        $this->resetInput();
        $this->emit('finishNews', 1, 'Data berita berhasil disimpan!');
        $this->emit('refresh');
    }

    public function update()
    {
        $this->validate($this->rulesUpdate, $this->messages);
        $cabang = Modelsnews::find($this->news_id);
        if (!$cabang) {
            return session()->flash('fail', 'berita tidak ditemukan');
        }

        $dir = 'news';

        $img_name = null;

        if ($this->image != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'png';
            imageManager::delete($cabang->banner);
            $this->image->storeAs('public/'.$dir, $imageName);
            $img_name = 'storage/news/'.$imageName;
            $cabang->banner = $img_name;
        }

        $cabang->title = $this->news_title;
        $cabang->subtitle= $this->subtitle;
        $cabang->description = $this->description;
        $cabang->link = $this->link;
        $cabang->date = $this->date;

        $cabang->save();

        $this->resetInput();
        $this->emit('finishNews', 1, 'Data berita berhasil diubah!');
        $this->emit('refresh');

        return session()->flash('success', 'Berhasil mengubah data berita!');
    }

    public function delete()
    {
        $cabang = Modelsnews::find($this->news_id);

        if (!$cabang) {
            return session()->flash('fail', 'news tidak ditemukan!');
        }
        imageManager::delete($cabang->banner);
        $name = $cabang->title;

        $cabang->delete();
        $this->emit('finishNews', 1, 'Data berita berhasil dihapus!');
        $this->emit('refresh');

        return session()->flash('success', 'berita '.$name.' Berhasil dihapus');
    }
}
