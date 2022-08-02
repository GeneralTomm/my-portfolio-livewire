<?php

namespace App\Http\Livewire\Front;

use App\Models\Admin\Abouts;
use Livewire\Component;

class AboutMe extends Component
{
    public $about;

    public function mount()
    {
        $this->about = Abouts::where('id', 1)->first();
    }
    public function render()
    {
        return view('livewire.front.about-me')->layout('layouts.front');
    }
}
