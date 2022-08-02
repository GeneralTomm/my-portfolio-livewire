<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Backend\Setting;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function mount(){
        // $settings = Setting::where('id',1)->first();
    }
    public function render()
    {
        return view('layouts.app');
    }
}
