<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\OrderSteps;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersStep extends Component
{
    public $ordersStep_id , $title, $description;
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
        $this->title = '';
        $this->description = '';
    }

    // function delete confirmation
    public function cancelDeleted(){
        $this->confirmation = false;
    }

    public function save(){
        $this->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        OrderSteps::updateOrCreate(['id'    => $this->ordersStep_id],
        [
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->ordersStep_id ? 'Orders Steps Updated Succesfully!' : 'Orders Steps Created Succesfully');
        $this->closeModal();
        $this->resetModal();
    }

    public function edit($id){
        $ordersSteps = OrderSteps::find($id);
        $this->ordersStep_id = $id;
        $this->title = $ordersSteps->title;
        $this->description = $ordersSteps->description;
        $this->openModal();
    }

    public function confirmationDeletedId($id){
        $this->confirmation = $id;
    }

    public function deleted($id){
        $ordersSteps = OrderSteps::find($id);
        $ordersSteps->delete();

        session()->flash('message' , 'Order Steps Deleted Successfully!');
    }

    public function render()
    {
        $OrderSteps = $this->search === null ? OrderSteps::latest()->paginate($this->paginate):
        OrderSteps::where('title' ,'LIKE' , '%'.$this->search.'%')
        ->latest()->paginate($this->paginate);
        return view('livewire.admin.orders-step',
    ['OrderSteps' => $OrderSteps]);
    }
}
