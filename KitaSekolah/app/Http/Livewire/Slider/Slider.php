<?php

namespace App\Http\Livewire\Slider;

use Livewire\Component;

class Slider extends Component
{
    public function render()
    {
        return view('livewire.slider.slider')->layout('layouts.app');
    }
}
