<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;

class Departemen extends Component
{
    public $departement_id, $nama_departement;
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
        $this->nama_departement = "";
    }

    public function simpan(){
        $this->validate([
            'nama_departement' => 'required'
        ]);

        Departement::updateOrCreate(['id' => $this->departement_id],[
            'nama_departement'    => $this->nama_departement,
        ]);

        session()->flash('message', $this->departement_id ? 'Departement berhasil diperbaharui!' : 'Departement berhasil dibuat!');
        $this->CloseModal();
        $this->resetModal();
    }

    public function edit($id) {
        $departement = Departement::findorFail($id);
        $this->departement_id = $id;
        $this->nama_departement = $departement->nama_departement;
        $this->openModal();
    }
    public function konfirmasiHapusId($id)
    {
        $this->konfirmasi = $id;
    }

    public function hapus($id){
        $departement = Departement::find($id);
        $departement->delete();

        session()->flash('message', 'Departement berhasil di Hapus!');
    }

    public function render()
    {
        return view('livewire.backend.departemen',[
            'departements'  => Departement::latest()->paginate(10)
        ]);
    }
}
