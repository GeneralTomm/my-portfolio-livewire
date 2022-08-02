<?php

namespace App\Http\Livewire;

use App\DataPerusahaan;
// use App\Models\DataPerusahaan as ModelsDataPerusahaan;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DataPerusahaanTable extends LivewireDatatable
{
    public $model = DataPerusahaan::class;

    // public $hideable = 'inline';
    // public $exportable = true;

    // public function builder(){
    //     return ModelsDataPerusahaan::query();
    // }
    public function columns()
    {
        //
    }
}
