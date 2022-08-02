<?php

namespace App\Http\Livewire\Backend;

use App\Models\Menu;
use Livewire\Component;

class MenuLivewire extends Component
{
    public $menu_id , $name, $status;
    public $isModal = false;
    public $isDelete = false;

    public $deleteId = '';

    public function openModal(){
        $this->isModal = true;
    }
    public function closeModal(){
        $this->isModal = false;
    }

    // delete modal
    public function openModalDelete(){
        $this->isDelete = true;
    }
    public function closeModalDelete(){
        $this->isDelete = false;
    }

    public function resetModal(){
        $this->name = null;
        $this->status = 0;
        $this->isModal = false;
    }

    public function createData(){
        $this->validate([
            'name' => 'required|min:3',
            'status' => 'required',
        ]);

        $data = [
            'name' => $this->name,
            'status' => $this->status,
        ];

        $datamenu = Menu::updateOrCreate(['id' => $this->menu_id], $data);
        session()->flash('success',$this->menu_id ? 'Menu successfully updated!' : 'Menu successfully created!');

        $this->closeModal();
        $this->resetModal();
    }

    public function editData($id){
        $menu = Menu::find($id);
        $this->menu_id = $menu->id;
        $this->name = $menu->name;
        $this->status = $menu->status;
        $this->openModal();
    }



    public function deleteId($id){
        $this->deleteId = $id;
        $this->openModalDelete();

    }

    public function Delete(){
        Menu::find($this->deleteId)->delete();
        session()->flash('success','Menu successfully deleted!');
        $this->closeModalDelete();
    }

    public function render()
    {
        $menu = Menu::orderBy('created_at', 'desc')->get();
        return view('livewire.backend.menu' ,[
            'menus' => $menu,
        ])->layout('layouts.app');
    }
}
