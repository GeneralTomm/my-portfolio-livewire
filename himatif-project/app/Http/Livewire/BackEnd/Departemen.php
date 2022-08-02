<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Backend\Setting;
use Illuminate\Support\Facades\File;
use App\Models\Backend\Departemen as ModelDepartemen;

class Departemen extends Component
{
    public $departemen_id , $nama, $deskripsi, $gambar, $gambar_lama;
    use WithPagination;
    use WithFileUploads;
    public $isModalOpen = 0;
    public $search;

    public function OpenModalDepartemen(){
        $this->isModalOpen = true;
    }
    public function CloseModalDepartemen(){
        $this->isModalOpen = false;
        $this->resetModal();
    }
    public function resetModal(){
        $this->nama = '';
        $this->deskripsi = '';
        $this->gambar = null;
    }

    public function render()
    {
        $settings = Setting::where('id' ,1)->first();

        $departemen = $this->search === null ? ModelDepartemen::latest()->paginate(5) :
            ModelDepartemen::where('nama' , 'LIKE' , '%'.$this->search.'%')->latest()->paginate(5);
        return view('livewire.back-end.departement.departemen',
        [
            'departemen'    => $departemen,
            'settings'    => $settings,
        ]);
    }

    public function simpan(){
        $gambarValidasi = '';
        if($this->gambar != $this->gambar_lama){
            $gambarValidasi = 'required|image|mimes:jpg,png,svg|max:1024';
        }

        $this->validate([
            'nama'=> 'required',
            'deskripsi'=> 'required',
            'gambar'=> $gambarValidasi,
        ]);



        if($this->gambar != $this->gambar_lama){
            $fileimages = public_path('\storage\\').$this->gambar;
            if(File::exists($fileimages)){
                File::delete($fileimages);
            }
                $fileGambar = $this->gambar->store('departemen' , 'public');
            }else{
                $fileGambar = $this->gambar;
        }

        ModelDepartemen::updateOrCreate(['id' => $this->departemen_id],[
            'nama'  => $this->nama,
            'deskripsi'  => $this->deskripsi,
            'gambar' => $fileGambar,
        ]);

        session()->flash('message', $this->departemen_id ? 'Berhasil memperbaharui departemen' : 'Berhasil menambahkan departemen!');
        $this->CloseModalDepartemen();
        $this->resetModal();

    }

    public function edit($id){
        $departemen = ModelDepartemen::find($id);
        $this->departemen_id =$departemen->id;
        $this->nama =$departemen->nama;
        $this->deskripsi =$departemen->deskripsi;
        $this->gambar =$departemen->gambar;
        $this->gambar_lama =$departemen->gambar;
        $this->OpenModalDepartemen();
    }

    public function hapus($id){
        $departemen = ModelDepartemen::find($id);
        $fileImages = public_path('\storage\\').$departemen->gambar;
        if(File::exists($fileImages)){
            File::delete($fileImages);
        }
        $departemen->delete();
        session()->flash('message', 'Event berhasil di Hapus!');
    }
}
