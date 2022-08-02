<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.front.profile')
        ->layout('layouts.frontpage');
    }
}
