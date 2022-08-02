<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Abouts;

class AboutMe extends Component
{
    public $about_id, $short_title, $title, $description;

    public function mount(){
        $about = Abouts::where('id', 1)->first();
        $this->about_id = $about->id;
        $this->title = $about->title;
        $this->short_title = $about->short_title;
        $this->description = $about->description;
    }

    public function AboutPage(){
        $this->validate([
            'title'  => 'required',
            'short_title'  => 'nullable',
            'description'  => 'nullable',
        ]);

        if($this->about_id){
            $about = Abouts::find($this->about_id);
            $about->update([
                'title'  => $this->title,
                'short_title'  => $this->short_title,
                'description'  => $this->description,
            ]);
            $about->save();
            session()->flash('message', 'About Page Updated Successfully!');
        }
    }
    public function render()
    {
        return view('livewire.admin.about-me');
    }
}
