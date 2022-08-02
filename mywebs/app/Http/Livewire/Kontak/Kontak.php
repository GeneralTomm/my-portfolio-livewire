<?php

namespace App\Http\Livewire\Kontak;

use App\Models\Kontak as ModelsKontak;
use Livewire\Component;

class Kontak extends Component
{
    public function render()
    {
        $kontak = ModelsKontak::latest()->paginate(5);
        return view('livewire.kontak.kontak',[
            'kontak'    => $kontak,
        ]);
    }
}
