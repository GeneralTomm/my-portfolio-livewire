<?php

namespace App\Http\Livewire\UsersDashboard;

use Livewire\Component;
use App\Models\Backend\Kelas;
use App\Models\Backend\PilihanKelas;

class KelasLivewire extends Component
{
    public function render()
    {
        $telahPilihKelas = PilihanKelas::query()->where('dipilih_user_id', '!=', null)->where('status', '=', '1')->get();
        // dd($telahPilihKelas);
        return view('livewire.users-dashboard.kelas-livewire',[
            'kelas'=> $telahPilihKelas
        ])->layout('layouts.pagesusers');
    }
}
