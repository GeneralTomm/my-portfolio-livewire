<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\CategoriesProjects;

class CategoriesProject extends Component
{
    public $categories_id, $name_categories_project, $slug;
    use WithPagination;

    public $isModalOpen =0;
    public function openDataModal(){
        $this->isModalOpen = true;
    }
    public function closeDataModal(){
        $this->isModalOpen = false;
        $this->resetDataModal();
    }

    public function resetDataModal(){
        $this->name_categories_project = '';
        $this->slug = '';
    }

    public function saveData(){
        $this->validate([
            'name_categories_project'   => 'required'
        ]);

        CategoriesProjects::updateOrCreate(['id' => $this->categories_id],[
            'name_categories_project'     => $this->name_categories_project,
            'slug'              => Str::slug($this->name_categories_project),
        ]);

        session()->flash('message', $this->categories_id ? 'Categories berhasil diperbaharui!' : 'Categories berhasil dibuat!');

        $this->closeDataModal();
        $this->resetDataModal();
    }

    public function edit($id){
        $categories = CategoriesProjects::findorFail($id);
        $this->categories_id = $categories->id;
        $this->name_categories_project = $categories->name_categories_project;
        $this->slug = $categories->slug;
        $this->openDataModal();
    }

    public function render()
    {
        $categories = CategoriesProjects::latest()->paginate(10);
        return view('livewire.admin.categories-project',
    [
        'categories' => $categories,
    ]);
    }
    public function trash($id){
        $categories = CategoriesProjects::find($id);
        $categories->delete();
        session()->flash('message', 'Categories Deleted Successfully');
    }
}
