<?php

namespace App\Http\Livewire\Backend;

use App\Models\Area as ModelsArea;
use Livewire\Component;
use Livewire\WithPagination;

class Area extends Component
{
    public $area_id, $nama_area;
    public $isModalOpen = 0;
    public $konfirmasi;
    use WithPagination;

    public function OpenModal(){
        $this->isModalOpen = true;
    }

    // batal hapus (reset)
    public function batalMenghapus(){
        $this->konfirmasi = false;
    }
    public function CloseModal(){
        $this->isModalOpen = false;
        $this->resetModal();
    }

    public function resetModal(){
        $this->nama_area = "";
    }

    public function simpan(){
        $this->validate([
            'nama_area' => 'required'
        ]);

        ModelsArea::updateOrCreate(['id' => $this->area_id],[
            'nama_area'    => $this->nama_area,
        ]);

        session()->flash('message', $this->area_id ? 'Area Updated Successfully' : 'Area Created Successfully!');
        $this->CloseModal();
        $this->resetModal();
    }

    public function edit($id) {
        $area = ModelsArea::findorFail($id);
        $this->area_id = $id;
        $this->nama_area = $area->nama_area;
        $this->openModal();
    }

    public function konfirmasiHapusId($id){
        $this->konfirmasi = $id;
    }

    public function hapus($id){
        $area = ModelsArea::find($id);
        $area->delete();

        session()->flash('message','Area Deleted Successfully!');
    }
    public function render()
    {
        return view('livewire.backend.area',
    [
        'areas' => ModelsArea::latest()->paginate(10)
    ]);
    }
}
