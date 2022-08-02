<?php

namespace App\Http\Livewire;

use App\Models\Departemen;
use App\Models\Tim;
use App\Models\Event;
use Livewire\Component;
use App\Models\KategoriEvent;
use App\Models\Kontak;

class Dashboard extends Component
{
    public function render()
    {
        $kategori = KategoriEvent::all();
        $tim = Tim::all();
        $event = Event::all();
        $departemen = Departemen::all();
        $kontak = Kontak::all();
        return view('livewire.dashboard',[
            'kategori'  => $kategori,
            'tim' => $tim,
            'event' => $event,
            'departemen' => $departemen,
            'kontak' => $kontak,
        ]);
    }
}
