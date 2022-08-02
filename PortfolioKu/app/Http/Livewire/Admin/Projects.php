<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CategoriesProjects;
use Illuminate\Support\Facades\File;
use App\Models\Projects as ModelProjects;

class Projects extends Component
{
    public $projects_id, $name , $url , $slug , $categoriesproject_id, $images, $description, $old_images;
    use WithPagination;
    use WithFileUploads;
    public $isModalOpen = 0;

    public function openDataModal(){
        $this->isModalOpen = true;
    }

    public function closeDataModal(){
        $this->isModalOpen = false;
        $this->resetModal();
    }

    public function resetModal(){
        $this->name = '';
        $this->url = '';
        $this->slug = '';
        $this->categoriesproject_id = '';
        $this->images = '';
        $this->description = '';
    }

    public function saveData(){
        $imageValidation = '';
        if($this->images != $this->old_images){
            $imageValidation = 'required|image|max:1024|mimes:jpg,png,jpeg';
        }

        $this->validate([
            'name' => 'required',
            'url'   => 'required|url',
            'description'   => 'required',
            'images'    => $imageValidation,
            'categoriesproject_id'   => 'required'
        ]);

        if($this->images != $this->old_images){
            $fileImages = public_path('\storage\\').$this->images;
                if(File::exists($fileImages)){
                    File::delete($fileImages);
                }
            $fileGambar = $this->images->store('projects', 'public');
        }else{
            $fileGambar = $this->images;
        }

        CategoriesProjects::updateOrCreate(['id' => $this->projects_id],
        [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'url' => $this->url,
            'description' => $this->description,
            'images' => $fileGambar,
            'categoriesproject_id' => $this->categoriesproject_id,
        ]);

        session()->flash(['message' ,$this->projects_id ? 'Projects Updated Created Succesfully' : 'Projects Created Successfully ']);
        $this->closeDataModal();
        $this->resetModal();


    }

    public function render()
    {
        $categories = CategoriesProjects::all();
        $projects = ModelProjects::latest()->paginate(10);
        return view('livewire.admin.projects', ['projects'  => $projects, 'categories' => $categories]);
    }
}
