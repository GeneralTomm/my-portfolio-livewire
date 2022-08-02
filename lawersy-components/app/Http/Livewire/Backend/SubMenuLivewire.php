<?php

namespace App\Http\Livewire\Backend;

use App\Models\Menu;
use App\Models\SubMenu;
use Livewire\Component;
use Livewire\WithPagination;

class SubMenuLivewire extends Component
{
    public $submenu_id , $nama_sub_menu, $menu_id;
    public $isModal = false;
    public $isDelete = false;
    public $search;
    public $filterMenu =null;

    use WithPagination;

    public $deleteId = '';

    public function openModal(){
        $this->isModal = true;
    }
    public function closeModal(){
        $this->isModal = false;
        $this->resetModal();
    }

    // delete modal
    public function openModalDelete(){
        $this->isDelete = true;
    }
    public function closeModalDelete(){
        $this->isDelete = false;
    }

    public function resetModal(){
        $this->nama_sub_menu = null;
        $this->menu_id = null;
    }

    public function createData(){
        $this->validate([
            'nama_sub_menu' => 'required',
            'menu_id' => 'required',
        ]);

        $data = [
            'nama_sub_menu' => $this->nama_sub_menu,
            'menu_id' => $this->menu_id,
        ];

        $datamenu = SubMenu::updateOrCreate(['id' => $this->submenu_id], $data);
        session()->flash('success',$this->submenu_id ? 'Menu successfully updated!' : 'Menu successfully created!');

        $this->resetModal();
        $this->closeModal();
    }

    public function editData($id){
        $menu = SubMenu::find($id);
        $this->submenu_id = $menu->id;
        $this->nama_sub_menu = $menu->nama_sub_menu;
        $this->menu_id = $menu->menu_id;
        $this->openModal();
        // $this->resetModal();
    }

    public function deleteId($id){
        $this->deleteId = $id;
        $this->openModalDelete();

    }

    public function Delete(){
        SubMenu::find($this->deleteId)->delete();
        session()->flash('success','Menu successfully deleted!');
        $this->closeModalDelete();
    }

    public function render()
    {
        $subMenu = SubMenu::orderBy('created_at','desc')->paginate(8);
        $menu = Menu::where('status', 1)->get();

        if(strlen($this->search) > 0){
            if($this->filterMenu == null){
                 $subMenu = $this->search === null ? SubMenu::latest()->paginate(8) :
                 SubMenu::where('nama_sub_menu' , 'LIKE' , '%'.$this->search.'%')
                                ->where('menu_id',$this->filterMenu)
                                ->paginate(8);
            }
        }
        elseif($this->filterMenu){
            $subMenu = $this->filterMenu === null ? SubMenu::latest()->get() :
            SubMenu::where('menu_id' ,$this->filterMenu)->paginate(8);
         }

        // dd($subMenu);
        return view('livewire.backend.sub-menu-livewire',[
            'subMenu' => $subMenu,
            'menu' => $menu,
        ])->layout('layouts.app');
    }
}
