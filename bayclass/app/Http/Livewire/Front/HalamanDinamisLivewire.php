<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class HalamanDinamisLivewire extends Component
{
    public function render()
    {
        return view('livewire.front.halaman-dinamis-livewire')->layout('layouts.frontpage');
    }
}
