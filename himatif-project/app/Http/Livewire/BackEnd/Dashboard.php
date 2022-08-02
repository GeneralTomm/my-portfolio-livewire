<?php

namespace App\Http\Livewire\BackEnd;

use Livewire\Component;
use App\Models\Backend\Setting;

class Dashboard extends Component
{
    public function render()
    {
        $settings = Setting::where('id' ,1)->first();

        return view('livewire.back-end.dashboard',
        [
            'settings' => $settings,
            ])
        ->layout('layouts.app');
    }
}
