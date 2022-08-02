<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Backend\Tim;
use App\Models\Backend\Departemen;
use App\Models\Backend\Event;
use App\Models\Backend\KategoriEvent;
use App\Models\Backend\Setting;

class Homepage extends Component
{
    public $events ,$settings, $tims , $departemen , $kategoriEvents;

    public $update;

    public function refreshComponent() {
        $this->update = !$this->update;
    }
    public function mount(){
        $this->events = Event::latest()->get();
        $this->departemen = Departemen::latest()->get();
        $this->kategoriEvents = KategoriEvent::all();
        $this->settings = Setting::where('id' , 1)->first();
        $this->tims = Tim::where('status' ,'aktif')->get();

    }
    public function render()
    {
        return view('pages.homepage')
        ->layout('layouts.frontpage');
    }
}
