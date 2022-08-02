<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Admin\Projects;
use Illuminate\Support\Facades\File;
use App\Models\Admin\CategoriesProjects;

class Project extends Component
{
    public $projects_id, $name, $slug, $url, $images, $description, $categoriesproject_id , $old_images, $new_image;

    public $isModalOpen = 0;
    public $paginate = 5;
    public $confirmation;
    public $isUploaded = 0;
    use WithPagination;
    use WithFileUploads;

    public $search;
    public $selectedCategory= null;

    public function openModal(){
        $this->isModalOpen= true;
    }

    public function closeModal(){
        $this->isModalOpen= false;
        $this->resetModal();
    }

    // deleted confirmation

    public function cancelDeleted(){
        $this->confirmation =false;
    }

    public function resetModal(){
        $this->name = '';
        $this->slug = '';
        $this->url = '';
        $this->images = null;
        $this->description = '';
        $this->categoriesproject_id = '';
    }

    public function save(){
        $imageValidation = '';
        if($this->images != $this->old_images){
            $imageValidation = 'nullable|image|mimes:jpg,png,svg|max:2048';
        }

        $this->validate([
            'name' => 'required',
            'url' => 'required',
            'categoriesproject_id' => 'required',
            'description' => 'required',
            'images' => $imageValidation,
        ]);

        if($this->images != $this->old_images){
            $fileimages = public_path('\storage\\').$this->images;
            if(File::exists($fileimages)){
                File::delete($fileimages);
            }
              $fileGambar = 'images-' . time() . $this->images->getClientOriginalName();

                $this->images->storeAs('public/project', $fileGambar);
                // $fileGambar = $this->images->storeAs('project' , 'public');
            }else{
                $fileGambar = $this->images;
        }

        $projects = Projects::updateOrCreate(['id' => $this->projects_id],[
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'url' => $this->url,
            'categoriesproject_id' => $this->categoriesproject_id,
            'images' => $fileGambar,

        ]);
        $this->isUploaded = false;

        if($projects){
            session()->flash('message', $this->projects_id ? 'Projects Updated Successfully!' : 'Project Created Successfully!');
        }

        $this->closeModal();
        $this->resetModal();
    }

    public function edit($id){
        $projects = Projects::find($id);
        $this->projects_id = $id;
        $this->name = $projects->name;
        $this->description = $projects->description;
        $this->slug = $projects->slug;
        $this->url = $projects->url;
        $this->images = $projects->images;
        $this->old_images = $projects->images;
        $this->categoriesproject_id = $projects->categoriesproject_id;
        $this->openModaL();
    }

    public function confirmationDeletedId($id){
        $this->confirmation = $id;
    }

    public function deleted($id){
        $projects = Projects::find($id);
        $fileImages = public_path('\storage\\').$projects->images;
        if(File::exists($fileImages)){
            File::delete($fileImages);
        }
        $projects->delete();
        session()->flash('message', 'Projects Deleted Successfully!');
    }

    public function render()
    {
        $categories =CategoriesProjects::all();
        $projects = Projects::with('categoriesproject')->orderBy('created_at' , 'desc')->get();
        $projects = $this->search === null ? Projects::latest()->paginate($this->paginate) :
        Projects::where('name' , 'LIKE' , '%' . $this->search . '%')->paginate($this->paginate);

        if(strlen($this->search) >2){
            if($this->selectedCategory){
                $projects = $this->search === null ? Projects::latest()->paginate($this->paginate):
                Projects::where('name' , 'LIKE' , '%' . $this->search . '%')
                ->paginate($this->paginate);
            }else{
                Projects::where('name' , 'LIKE' , '%' . $this->search. '%')->paginate($this->paginate);
            }
        }else if($this->selectedCategory){
            $projects = $this->selectedCategory === null ? Projects::latest()->paginate($this->paginate) :
            Projects::where('categoriesproject_id' ,$this->selectedCategory)->paginate($this->paginate);
       }
        return view('livewire.admin.project',
    [
        'projects' => $projects,
        'categories'    => $categories,
    ]);
    }
}
