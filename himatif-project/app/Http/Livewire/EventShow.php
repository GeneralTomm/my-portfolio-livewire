<?php

namespace App\Http\Livewire;

use App\Models\Backend\Event;
use Livewire\Component;

class EventShow extends Component
{
    public $event ,$event_id , $gambar, $nama_event, $deskripsi, $pendaftaran, $acara_mulai, $alamat, $acara_selesai, $slug
    ,$kategorievent_id; 

    public function mount(Event $event){
        $this->event = $event;
    }

    public function render()
    { 
        
        return view('livewire.event-show')
        ->layout('layouts.frontpage');
    }
}
