<?php

namespace App\Http\Livewire\Front;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MasukLivewire extends Component
{
    public const MASUK_NOTIFIKASI = 'Berhasil masuk dengan datamu!';
    public const KELUAR_NOTIFIKASI = 'Berhasil keluar dengan datamu!';
    public const MASUK_NOTIFIKASI_GAGAL = 'Gagal login, periksa kesalahan email atau password anda !';

    public  $email = '', $password = '';
    public $validasi_login = 1;
    public function resetForm(){
        $this->email = null;
        $this->password = null;
    }

    protected $rules = 
    [
        'email' => 'required',
        'password' => 'required'
    ];

    public function masukForm(){

        $this->validate();

        $user = User::where('email', '=', $this->email)->first();

        if(!$user){
            $this->validasi_login = 0;
            $this->dispatchBrowserEvent('swal',[
                'title' => $this::MASUK_NOTIFIKASI_GAGAL,
                'icon'=> 'error'
            ]);
            return;
        }

        if(!Hash::check($this->password, $user->password)){
            $this->validasi_login = 0;
            $this->dispatchBrowserEvent('swal',[
                'title' => $this::MASUK_NOTIFIKASI_GAGAL,
                'icon'=> 'error'
            ]);
            return;
        }

        $user->validasi_login = 1;

        if($user->validasi_login != 1){
            $this->validasi_login = 0;
            $this->dispatchBrowserEvent('swal',[
                'title' => $this::MASUK_NOTIFIKASI_GAGAL,
                'icon'=> 'error'
            ]);
            return;
        }

        $user->save();

        Auth::login($user);

        $this->dispatchBrowserEvent('swal',[
            'title' => $this::MASUK_NOTIFIKASI,
            'icon'=> 'success'
        ]);

        return redirect()->route('beranda');
        $this->resetForm();
        
    }
    

    public function render()
    {
        return view('livewire.front.masuk-livewire')->layout('layouts.pagesloginregister');
    }
}
