<?php

namespace App\Http\Livewire\Backend;

use App\Models\Tipe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Area;
use App\Models\DataPerusahaan;
use App\Models\Departement;
use App\Models\Section;

class Home extends Component
{
    public $dp_id , $name, $departement_id , $section_id,  $tipe_id, $area_id, $nip , $alamat, $tanggal , $seksi;
    public $departement_data, $section_data, $tipe_data, $area_data;

    public $isModalOpen = false;
    public $isModalData = false;
    public $konfirmasi;
    public $DepartementSelected = null;
    public $AreaSelected = null;
    public $SectionSelected = null;
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function OpenModal(){
        $this->isModalOpen = true;
    }

    public function OpenModalData(){
        $this->isModalData= true;
    }

    public function CloseModalData(){
        $this->isModalData= false;
        $this->ResetModal();
    }

    public function batalMenghapus(){
        $this->konfirmasi =false;
    }

    public function CloseModal(){
        $this->isModalOpen = false;
        $this->ResetModal();
    }

    public function ResetModal(){
        $this->name = '';
        $this->departement_id = '';
        $this->section_id = '';
        $this->tipe_id = '';
        $this->area_id = '';
        $this->nip = '';
        $this->alamat = '';
        $this->tanggal = '';
        $this->seksi = '';
    }

    public function simpan(){
        $this->validate([
            'name'  => 'required',
            'departement_id'  => 'required',
            'area_id'  => 'required',
            'tipe_id'  => 'required',
            'section_id'  => 'required',
            'alamat'  => 'required',
            'seksi'  => 'required',
            'tanggal'  => 'required|date',
            'nip'   => 'required|max:18|min:12',
        ]);

        DataPerusahaan::updateOrCreate(['id' => $this->dp_id],[
            'name'  => $this->name,
            'departement_id'  => $this->departement_id,
            'area_id'  => $this->area_id,
            'tipe_id'  => $this->tipe_id,
            'section_id'  => $this->section_id,
            'seksi'  => $this->seksi,
            'alamat'  => $this->alamat,
            'tanggal'  => $this->tanggal,
            'nip'  => $this->nip,
        ]);

        session()->flash('message', $this->dp_id ? 'Data Updated Successfully!' : 'Data Created Successfully!');
        $this->CloseModal();
        $this->ResetModal();
    }
    public function edit($id) {
        $dp = DataPerusahaan::findorFail($id);
        $this->dp_id = $id;
        $this->nip = $dp->nip;
        $this->name = $dp->name;
        $this->departement_id = $dp->departement_id;
        $this->section_id = $dp->section_id;
        $this->tipe_id = $dp->tipe_id;
        $this->area_id = $dp->area_id;
        $this->seksi = $dp->seksi;
        $this->alamat = $dp->alamat;
        $this->tanggal = $dp->tanggal;
        $this->OpenModal();
    }

    public function detail($id){
        $dp = DataPerusahaan::findorFail($id);
        $this->dp_id = $id;
        $this->nip = $dp->nip;
        $this->name = $dp->name;
        $this->departement_data = $dp->departement->nama_departement;
        $this->section_data = $dp->section->section;
        $this->tipe_data = $dp->tipe->nama_tipe;
        $this->area_data = $dp->area->nama_area;
        $this->seksi = $dp->seksi;
        $this->alamat = $dp->alamat;
        $this->tanggal = $dp->tanggal;
        $this->OpenModalData();
    }
    public function konfirmasiHapusId($id)
    {
        $this->konfirmasi = $id;
    }

    public function hapus($id){
        $dp = DataPerusahaan::find($id);
        $dp->delete();

        session()->flash('message', ' Data deleted successfully');
    }
    public function render()
    {
        $dataPerusahaan = DataPerusahaan::orderBy('created_at' , 'desc')->paginate(10);

        if(strlen($this->search) > 2 ) {
             if($this->DepartementSelected){
                 $dataPerusahaan = $this->search === null ? DataPerusahaan::latest()->paginate(5) :
                 DataPerusahaan::where('name' , 'LIKE' , '%'.$this->search.'%')
                                ->where('departement_id',$this->DepartementSelected)
                                ->paginate(5);
             }elseif($this->AreaSelected){
                 $dataPerusahaan = $this->search === null ? DataPerusahaan::latest()->paginate(5) :
                 DataPerusahaan::where('name' , 'LIKE' , '%'.$this->search.'%')
                                ->where('area_id',$this->AreaSelected)
                                ->paginate(5);
             }elseif($this->SectionSelected){
                 $dataPerusahaan = $this->search === null ? DataPerusahaan::latest()->paginate(5) :
                 DataPerusahaan::where('name' , 'LIKE' , '%'.$this->search.'%')
                                ->where('section_id',$this->SectionSelected)
                                ->paginate(5);
             }
             else{
                 $dataPerusahaan = DataPerusahaan::where('name' , 'LIKE' , '%'.$this->search.'%')
                                ->paginate(5);
             }
         }else if($this->DepartementSelected){
              $dataPerusahaan = $this->DepartementSelected === null ? DataPerusahaan::latest()->paginate(5) :
                DataPerusahaan::where('departement_id' ,$this->DepartementSelected)->paginate(5);
         }else if($this->AreaSelected){
              $dataPerusahaan = $this->AreaSelected === null ? DataPerusahaan::latest()->paginate(5) :
                DataPerusahaan::where('area_id' ,$this->AreaSelected)->paginate(5);
         }else if($this->SectionSelected){
              $dataPerusahaan = $this->SectionSelected === null ? DataPerusahaan::latest()->paginate(5) :
                DataPerusahaan::where('section_id' ,$this->SectionSelected)->paginate(5);
         }


        return view('livewire.backend.home',[
            'tipe'  => Tipe::all(),
            'sections'  => Section::all(),
            'departement'  => Departement::all(),
            'area'  => Area::all(),
            'dataPerusahaan' => $dataPerusahaan
        ]);
    }
}
