<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Admin\CategoriesProjects;

class CategoriesProject extends Component
{
    public $categoriesprojects_id , $name, $slug;
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
        $this->slug = '';
    }

    // function delete confirmation
    public function cancelDeleted(){
        $this->confirmation = false;
    }

    public function save(){
        $this->validate([
            'name' => 'required'
        ]);

        CategoriesProjects::updateOrCreate(['id'    => $this->categoriesprojects_id],
        [
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        session()->flash('message', $this->categoriesprojects_id ? 'Categories Updated Succesfully!' : 'Categories Created Succesfully');
        $this->closeModal();
        $this->resetModal();
    }

    public function edit($id){
        $categories = CategoriesProjects::find($id);
        $this->categoriesprojects_id = $id;
        $this->name = $categories->name;
        $this->openModal();
    }

    public function confirmationDeletedId($id){
        $this->confirmation = $id;
    }

    public function deleted($id){
        $categories = CategoriesProjects::find($id);
        $categories->delete();

        session()->flash('message' , 'Categories Deleted Successfully!');
    }

    public function render()
    {
        $categories = $this->search === null ? CategoriesProjects::latest()->paginate($this->paginate):
        CategoriesProjects::where('name' ,'LIKE' , '%'.$this->search.'%')
        ->orWhere('slug' , 'LIKE' , '%'.$this->search.'%')
        ->latest()->paginate($this->paginate);
        return view('livewire.admin.categories-project',
    [
        'categories' => $categories,
    ]);
    }
}
