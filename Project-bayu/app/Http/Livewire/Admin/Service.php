<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Services;

class Service extends Component
{
    public $services_id , $name, $status;
    use WithPagination;
    public $confirmation;
    public $paginate = 5;
    public $isModalOpen = 0;
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function openModal(){
        $this->isModalOpen = true;
    }

    public function closeModal(){
        $this->isModalOpen = false;
        $this->resetModal();
    }

    public function resetModal(){
        $this->name = '';
        $this->status = '';
    }

    // function delete confirmation
    public function cancelDeleted(){
        $this->confirmation = false;
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        Services::updateOrCreate(['id'    => $this->services_id],
        [
            'name' => $this->name,
            'status' => $this->status,
        ]);

        session()->flash('message', $this->services_id ? 'Services Updated Succesfully!' : 'Services Created Succesfully');
        $this->closeModal();
        $this->resetModal();
    }

    public function edit($id){
        $services = Services::find($id);
        $this->services_id = $id;
        $this->name = $services->name;
        $this->status = $services->status;
        $this->openModal();
    }

    public function confirmationDeletedId($id){
        $this->confirmation = $id;
    }

    public function deleted($id){
        $services = Services::find($id);
        $services->delete();

        session()->flash('message' , 'Services Deleted Successfully!');
    }

    public function render()
    {
        $services = $this->search === null ? Services::latest()->paginate($this->paginate):
        Services::where('name' ,'LIKE' , '%' . $this->search. '%')->paginate($this->paginate);
        return view('livewire.admin.service',
    [
        'services'  => $services,
    ]);
    }
}
