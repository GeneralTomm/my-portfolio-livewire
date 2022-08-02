<?php

namespace App\Http\Livewire\Backend;

use App\Models\Tipe as ModelsTipe;
use Livewire\Component;
use Livewire\WithPagination;

class Tipe extends Component
{
    public $tipe_id, $nama_tipe;
    public $isModalOpen = 0;
    public $konfirmasi;
    use WithPagination;

    public function OpenModal(){
        $this->isModalOpen = true;
    }

    public function batalMenghapus(){
        $this->konfirmasi = false;
    }

    public function CloseModal(){
        $this->isModalOpen = false;
        $this->resetModal();
    }

    public function resetModal(){
        $this->nama_tipe = "";
    }

    public function simpan(){
        $this->validate([
            'nama_tipe' => 'required'
        ]);

        ModelsTipe::updateOrCreate(['id' => $this->tipe_id],[
            'nama_tipe'    => $this->nama_tipe,
        ]);

        session()->flash('message', $this->tipe_id ? 'Tipe Updated Successfully!' : 'Tipe Created Successfully!');
        $this->CloseModal();
        $this->resetModal();
    }

    public function edit($id) {
        $tipee = ModelsTipe::findorFail($id);
        $this->tipe_id = $id;
        $this->nama_tipe = $tipee->nama_tipe;
        $this->openModal();
    }

    public function konfirmasiHapusId($id){
        $this->konfirmasi = $id;
    }

    public function hapus($id){
        $tipee = ModelsTipe::find($id);
        $tipee->delete();

        session()->flash('message', 'Tipe Deleted Successfully!');
    }
    public function render()
    {
        return view('livewire.backend.tipe',
    [
        'tipee' => ModelsTipe::latest()->paginate(10)
    ]);
    }
}
