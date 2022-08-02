<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class KelasSemuaLivewire extends Component
{
    public function render()
    {
        return view('livewire.front.kelas-semua-livewire')->layout('layouts.frontpage');
    }
}
