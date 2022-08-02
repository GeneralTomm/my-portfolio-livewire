<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Tim as ModelsTim;
use Illuminate\Support\Facades\File;

class Tim extends Component
{
    public $tim_id , $nama, $jabatan, $instagram , $twitter, $facebook, $gambar, $status , $gambar_lama;
    use WithPagination;
    use WithFileUploads;
    public $isModalOpen = 0;
    public $isModalData = 0;

    public $search;


    // open detail data
    public function OpenDataTim(){
        $this->isModalData = true;
    }
    public function CloseDataTim(){
        $this->isModalData = false;
        $this->resetTim();
    }

    public function CloseModalTim(){
        $this->isModalOpen = false;
        $this->resetTim();
    }

    // create and update function
     public function OpenModalTim(){
        $this->isModalOpen = true;
    }

    public function ResetTim(){
        $this->nama = '';
        $this->jabatan = '';
        $this->instagram = '';
        $this->twitter = '';
        $this->facebook = '';
        $this->status = '';
        $this->gambar = null;
    }
    public function render()
    {
        $tim = ModelsTim::latest()->paginate(10);
        return view('livewire.team.tim',[
            'tim' => $tim
        ]);
    }

    public function simpan(){
        $gambarValidasi = '';
        if($this->gambar != $this->gambar_lama){
            $gambarValidasi = 'required|image|max:2040|mimes:jpg,png,jpeg';
        }

        $this->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'instagram' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'gambar' => $gambarValidasi
        ]);

        if($this->gambar != $this->gambar_lama){
            $fileImages = public_path('\storage\\').$this->gambar;
                if(File::exists($fileImages)){
                    File::delete($fileImages);
                }
            $fileGambar = $this->gambar->store('tim', 'public');
        }else{
            $fileGambar = $this->gambar;
        }

        ModelsTim::updateOrCreate(['id' => $this->tim_id],
        [
            'nama'  => $this->nama,
            'jabatan'   => $this->jabatan,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter'   => $this->twitter,
            'gambar' => $fileGambar,
            'status'    => $this->status,
        ]);

        session()->flash('message', $this->tim_id ? 'Berhasil memperbaharui Tim' : 'Berhasil Menambahkan Tim');
        $this->closeModalTim();
        $this->resetTim();

    }

    public function edit($id){
        $tim = ModelsTim::find($id);
        $this->tim_id = $tim->id;
        $this->nama = $tim->nama;
        $this->jabatan = $tim->jabatan;
        $this->instagram = $tim->instagram;
        $this->facebook = $tim->facebook;
        $this->twitter = $tim->twitter;
        $this->gambar = $tim->gambar;
        $this->gambar_lama = $tim->gambar;
        $this->status = $tim->status;
        $this->OpenModalTim();
    }

    public function lihat($id){
        $tim = ModelsTim::findorFail($id);
        $this->tim_id = $tim->id;
        $this->nama = $tim->nama;
        $this->jabatan = $tim->jabatan;
        $this->instagram = $tim->instagram;
        $this->facebook = $tim->facebook;
        $this->twitter = $tim->twitter;
        $this->gambar = $tim->gambar;
        $this->gambar_lama = $tim->gambar;
        $this->status = $tim->status;
        $this->OpenDataTim();
    }
    public function hapus($id){
        $tim = ModelsTim::find($id);
        $fileImages = public_path('\storage\\').$tim->gambar;
        if(File::exists($fileImages)){
            File::delete($fileImages);
        }
        $tim->delete();
        session()->flash('message', 'Event berhasil di Hapus!');
    }


}
