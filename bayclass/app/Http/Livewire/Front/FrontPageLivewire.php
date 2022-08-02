<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class FrontPageLivewire extends Component
{
    public function render()
    {
        return view('livewire.front.front-page-livewire')->layout('layouts.frontpage');
    }
}
