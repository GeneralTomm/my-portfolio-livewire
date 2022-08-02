<?php

namespace App\Http\Livewire\KategoriEvent;

use App\Models\KategoriEvent as ModelsKategoriEvent;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class KategoriEvent extends Component
{
    public $kategorievent_id, $nama_kategori, $slug,  $status;
    public $isModalOpen = 0;

    // extension
    use WithPagination;

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


    public function render()
    {
        $kategoriEvent = ModelsKategoriEvent::latest()->paginate(10);
        return view('livewire.kategori-event.kategori-event',[
            'kategoriEvent' => $kategoriEvent,
        ]);
    }

    public function simpan(){
        $this->validate([
            'nama_kategori' => 'required',
            'status'        => 'required'
        ]);

        ModelsKategoriEvent::updateOrCreate(['id' => $this->kategorievent_id],[
            'nama_kategori'     => $this->nama_kategori,
            'slug'              => Str::slug($this->nama_kategori),
            'status'            => $this->status,
        ]);
        session()->flash('message', $this->kategorievent_id ? 'Event berhasil diperbaharui!' : 'Event berhasil dibuat!');
        $this->CloseKategoriEventModal();
        $this->ResetKategoriEventModal();
    }

    public function edit($id){
        $kategoriEvent = ModelsKategoriEvent::findorFail($id);
        $this->kategorievent_id = $kategoriEvent->id;
        $this->nama_kategori = $kategoriEvent->nama_kategori;
        $this->slug = $kategoriEvent->slug;
        $this->status = $kategoriEvent->status;
        $this->OpenKategoriEventModal();
    }
}
