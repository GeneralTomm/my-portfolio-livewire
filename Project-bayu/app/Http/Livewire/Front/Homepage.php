<?php

namespace App\Http\Livewire\Front;

use App\Models\Admin\Settings;
use Livewire\Component;

class Homepage extends Component
{
    // public $setting;
    public function render()
    {
        $setting = Settings::where('id', 1)->first();
        return view(
            'front.homepage',
            [
                'setting' => $setting
            ]
        )->layout('layouts.front');
    }
}
