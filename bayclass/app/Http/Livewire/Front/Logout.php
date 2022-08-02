<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public $email , $validasi_login;
    public const KELUAR_NOTIFIKASI = 'Berhasil keluar dengan datamu!';

    

    public function keluarAplikasi()
    {
        $user = User::where('validasi_login', '=', 1)->first();
        $user->validasi_login = 0;

        if($user->validasi_login != 0){
            return redirect()->route('masuk');
        }
        $user->save();

        Auth::logout();

        $this->dispatchBrowserEvent('swal',[
            'title' => $this::KELUAR_NOTIFIKASI,
            'icon'=> 'success'
        ]);

        $this->emit('keluarAplikasi');

        return redirect()->route('masuk');
    }
    
    public function render()
    {
        return view('livewire.front.logout')->layout('layouts.pagesusers');
    }
}
