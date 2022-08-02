<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Backend\Event;
use App\Models\Backend\KategoriEvent;
use Illuminate\Session\SessionManager;

class EventAcara extends Component
{
    public $search;
    public $PilihEvent = null;

    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        $kategoriEvents = KategoriEvent::where('status', 'aktif')->get();
         $events =  Event::orderBy('created_at','desc')->paginate(5);
         if(strlen($this->search) > 2 ) {
             if($this->PilihEvent){
                 $events = $this->search === null ? Event::latest()->paginate(5) :
                 Event::where('nama_event' , 'LIKE' , '%'.$this->search.'%')
                                ->where('kategorievent_id',$this->PilihEvent)
                                ->paginate(5);
                //  $events = Event::where('nama_event' , 'LIKE' , '%'.$this->search.'%')
                //                 ->where('kategorievent_id',$this->PilihEvent)
                //                 ->paginate(5);
             }else{
                 $events = Event::where('nama_event' , 'LIKE' , '%'.$this->search.'%')
                                ->paginate(5);
             }
         }else if($this->PilihEvent){
              $events = $this->PilihEvent === null ? Event::latest()->paginate(5) :
                Event::where('kategorievent_id' ,$this->PilihEvent)->paginate(5);
         }

        $kategoriEvents = KategoriEvent::where('status' ,'aktif')->get();
        return view('livewire.front.event-acara',[
            'events' => $events,
            'kategoriEvents' => $kategoriEvents,
        ])
        ->layout('layouts.frontpage');

    }
}
