<?php

namespace App\Http\Livewire\Backend;

use App\Models\Section as ModelsSection;
use Livewire\Component;
use Livewire\WithPagination;

class Section extends Component
{
    public $section_id, $section;
    public $konfirmasi;
    public $isModalOpen = 0;
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
        $this->section = "";
    }

    public function simpan(){
        $this->validate([
            'section' => 'required'
        ]);

        ModelsSection::updateOrCreate(['id' => $this->section_id],[
            'section'    => $this->section,
        ]);

        session()->flash('message', $this->section_id ? 'Section Updated Successfully!' : 'Section Successfully Created!');
        $this->CloseModal();
        $this->resetModal();
    }

    public function edit($id) {
        $sections = ModelsSection::findorFail($id);
        $this->section_id = $id;
        $this->section = $sections->section;
        $this->openModal();
    }

     public function konfirmasiHapusId($id)
    {
        $this->konfirmasi = $id;
    }

    public function hapus($id){
        $sections = ModelsSection::find($id);
        $sections->delete();

        session()->flash('message', 'Section Deleted Successfully!');
    }
    public function render()
    {
        return view('livewire.backend.section',
    [
        'sections'  => ModelsSection::latest()->paginate(10)
    ]);
    }
}
