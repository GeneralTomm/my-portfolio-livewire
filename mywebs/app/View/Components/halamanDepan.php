<?php

namespace App\View\Components;

use App\Models\PengaturanWeb;
use Illuminate\View\Component;

class halamanDepan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $pengaturan = PengaturanWeb::where('id' ,1)->first();
        return view('components.halaman-depan',
    [
        'pengaturan'    => $pengaturan,
    ])->layout('layouts.depan');
    }
}
