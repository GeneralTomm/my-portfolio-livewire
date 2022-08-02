<?php

namespace App\Http\Livewire\BackEnd;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Backend\Setting;
use App\Models\Backend\KategoriEvent as ModelKategoriEvent;

class KategoriEvent extends Component
{
    public $kategorievent_id, $nama_kategori, $slug,  $status;
    public $isModalOpen = 0;

    // extension
    use WithPagination;
    public $search;

    public function OpenKategoriEventModal(){
        $this->isModalOpen = true;
    }

    public function CloseKategoriEventModal(){
        $this->isModalOpen = false;
        $this->ResetKategoriEventModal();
    }

    public function ResetKategoriEventModal(){
        $this->nama_kategori = "";
        $this->slug = "";
        $this->status = "";
    }

    public function simpan(){
        $this->validate([
            'nama_kategori' => 'required',
            'status'        => 'required'
        ]);

        ModelKategoriEvent::updateOrCreate(['id' => $this->kategorievent_id],[
            'nama_kategori'     => $this->nama_kategori,
            'slug'              => Str::slug($this->nama_kategori),
            'status'            => $this->status,
        ]);
        session()->flash('message', $this->kategorievent_id ? 'Event berhasil diperbaharui!' : 'Event berhasil dibuat!');
        $this->CloseKategoriEventModal();
        $this->ResetKategoriEventModal();
    }

    public function edit($id){
        $kategoriEvent = ModelKategoriEvent::findorFail($id);
        $this->kategorievent_id = $kategoriEvent->id;
        $this->nama_kategori = $kategoriEvent->nama_kategori;
        $this->slug = $kategoriEvent->slug;
        $this->status = $kategoriEvent->status;
        $this->OpenKategoriEventModal();
    }
    public function render()
    {
        $settings = Setting::where('id' ,1)->first();
        $kategoriEvent = $this->search === null ? ModelKategoriEvent::latest()->paginate(5) :
        ModelKategoriEvent::where('nama_kategori' , 'LIKE' , '%'.$this->search.'%')->latest()->paginate(5);
        return view('livewire.back-end.kategori.kategori-event',
            [
                'kategoriEvent' => $kategoriEvent,
                'settings' => $settings,
            ]);
    }

    public function hapus($id){
        $kategori = ModelKategoriEvent::find($id);
        $kategori->delete();
    }

}
