<?php

namespace App\Http\Livewire\BackEnd;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Backend\Setting;
use Illuminate\Support\Facades\File;
use App\Models\Backend\KategoriEvent;
use App\Models\Backend\Event as ModelEvent;

class Event extends Component
{
    public $event_id, $gambar, $nama_event, $deskripsi, $pendaftaran, $acara_mulai, $alamat, $acara_selesai, $slug
    ,$old_gambar ,$kategorievent_id ,$acara_hari_ini, $pendaftar;

    use WithPagination;
    use WithFileUploads;
    public $isModalOpen = 0;
    public $cariKategori = null;
    public $cariPendaftaran = 'buka';
    public $perhalaman = 5;
    public $perubahanStatus;

    public $search;

    public function OpenModalEvent(){
        $this->isModalOpen = true;
    }

    public function CloseModalEvent(){
        $this->isModalOpen = false;
        $this->resetModalEvent();
    }

    public function resetModalEvent(){
        $this->nama_event = "";
        $this->deskripsi = "";
        $this->alamat = "";
        $this->acara_mulai = "";
        $this->acara_selesai = "";
        $this->slug = "";
        $this->pendaftaran = "";
        $this->kategorievent_id = "";
        $this->gambar = null;
    }

    public function render()
    {
        $settings = Setting::where('id' ,1)->first();
        $kategori_event = KategoriEvent::where('status', 'aktif')->get();
        return view('livewire.back-end.eventss.event',
    [
        'Kategori_event' => $kategori_event,
        'settings' => $settings,

            'Acara' => $this->search === null ? ModelEvent::latest()->paginate($this->perhalaman) :
            ModelEvent::where('nama_event' , 'LIKE' , '%'.$this->search.'%')->latest()->paginate($this->perhalaman)
            ->when($this->cariKategori,function($query){
                $query->where('kategorievent_id',$this->cariKategori);
            })->paginate($this->perhalaman),
    ]);
    }
    public function simpan() {

        $gambarValidasi = '';
        if($this->gambar != $this->old_gambar){
            $gambarValidasi = 'required|image|max:1024|mimes:jpg,png,jpeg';
        }

        $this->validate([
            'nama_event'    => 'required',
            'acara_mulai'   => 'date|required|after:date:tomorrow',
            'acara_selesai' => 'date|required',
            'deskripsi'     => 'required',
            'alamat'        => 'required',
            'pendaftaran'   => 'required',
            'kategorievent_id'  => 'required',
            'gambar'        => $gambarValidasi
        ]);

        if($this->gambar != $this->old_gambar){
            $fileImages = public_path('\storage\\').$this->gambar;
                if(File::exists($fileImages)){
                    File::delete($fileImages);
                }
            $fileGambar = $this->gambar->store('event', 'public');
        }else{
            $fileGambar = $this->gambar;
        }

        ModelEvent::updateOrCreate(['id' => $this->event_id],[
            'nama_event'    => $this->nama_event,
            'slug'          => Str::slug($this->nama_event),
            'acara_mulai'   => $this->acara_mulai,
            'acara_selesai'   => $this->acara_selesai,
            'deskripsi'   => $this->deskripsi,
            'alamat'   => $this->alamat,
            'pendaftaran'   => $this->pendaftaran,
            'kategorievent_id'   => $this->kategorievent_id,
            'gambar'    => $fileGambar
        ]);



        session()->flash('message', $this->event_id ? 'Event berhasil diperbaharui!' : 'Event berhasil dibuat!');
        $this->CloseModalEvent();
        $this->resetModalEvent();
    }

    public function edit($id){
        $acara = ModelEvent::findorFail($id);
        $this->event_id = $id;
        $this->nama_event = $acara->nama_event;
        $this->acara_mulai = $acara->acara_mulai;
        $this->acara_selesai = $acara->acara_selesai;
        $this->deskripsi = $acara->deskripsi;
        $this->alamat = $acara->alamat;
        $this->pendaftaran = $acara->pendaftaran;
        $this->gambar = $acara->gambar;
        $this->kategorievent_id = $acara->kategorievent_id;
        $this->old_gambar = $acara->gambar;
        $this->openModalEvent();
    }

    public function hapus($id){
        $event = ModelEvent::find($id);
        $fileImages = public_path('\storage\\').$event->gambar;
        if(File::exists($fileImages)){
            File::delete($fileImages);
        }
        $event->delete();
        session()->flash('message', 'Event berhasil di Hapus!');
    }
}
