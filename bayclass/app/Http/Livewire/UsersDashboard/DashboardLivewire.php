<?php

namespace App\Http\Livewire\UsersDashboard;

use Livewire\Component;

class DashboardLivewire extends Component
{

    public $user , $name;
    public function mount(){
        $this->user = auth()->user();
        $this->name = $this->user->name;
    }


    public function render()
    {
        return view('livewire.users-dashboard.dashboard-livewire')->layout('layouts.pagesusers');
    }
}
