<?php

namespace App\Http\Livewire\Admin;

use Livewire\{Component,WithPagination};
#use Livewire\WithPagination;
use App\Models\Admin\Testimonials;

class Testimonial extends Component
{
    use WithPagination;
    public $testimonial_id , $name, $description,$confirmation,$search;
    public $paginate = 5;
    public $isModalOpen = 0;

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
        $this->description = '';
    }

    // function delete confirmation
    public function cancelDeleted(){
        $this->confirmation = false;
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Testimonials::updateOrCreate(['id'    => $this->testimonial_id],
        [
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->testimonial_id ? 'Testimonial Updated Succesfully!' : 'Testimonial Created Succesfully');
        $this->closeModal();
        $this->resetModal();
    }

    public function edit($id){
        $testimonials = Testimonials::find($id);
        $this->testimonial_id = $id;
        $this->name = $testimonials->name;
        $this->description = $testimonials->description;
        $this->openModal();
    }

    public function confirmationDeletedId($id){
        $this->confirmation = $id;
    }

    public function deleted($id){
        $testimonials = Testimonials::find($id);
        $testimonials->delete();

        session()->flash('message' , 'Testimonials Deleted Successfully!');
    }
    public function render()
    {
        // use Testimonials::when() tapi saya ragu.
        $testimonials = $this->search === null ? Testimonials::latest()->paginate($this->paginate):
        Testimonials::where('name' ,'LIKE' , '%'.$this->search.'%')
        ->orWhere('slug' , 'LIKE' , '%'.$this->search.'%')
        ->latest()->paginate($this->paginate);
        return view('livewire.admin.testimonial',
    [
        'Testimonials' => $testimonials,
    ]);
    }
}
