<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class ResetLivewire extends Component
{
    public function render()
    {
        return view('livewire.front.reset-livewire')->layout('layouts.pagesloginregister');
    }
}
