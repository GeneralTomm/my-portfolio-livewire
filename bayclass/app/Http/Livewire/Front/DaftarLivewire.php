<?php

namespace App\Http\Livewire\Front;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class DaftarLivewire extends Component
{

    public const DAFTAR_NOTIFIKASI = 'Lanjut ke halaman masuk ya sobat!';
    public const DAFTAR_NOTIFIKASI_GAGAL = 'Gagal daftar, periksa kesalahan datamu !';
    public const BERHASIL = 'Berhasil !';
    public const GAGAL = 'Gagal !';

    public $name, $email, $password, $password_confirmation, $nomor_hp;

    public function resetForm(){

        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->nomor_hp = null;

    }

    protected $rules = 
    [
        'name' => 'required',
        'email' => 'required|email:dns|unique:users',
        'nomor_hp' => 'required|regex:/(08)[0-9]/|not_regex:/[a-z]/|min:11|max:15',
        'password' => 'required|min:6|confirmed',
    ];

    public function daftarUsers()
    {
        try{

            $validatedData = $this->validate();
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'nomor_hp' => $validatedData['nomor_hp'],
            ]);

            if($user){
                $this->dispatchBrowserEvent('swal',[
                    'icon'=>'success',
                    'title'=> $this::DAFTAR_NOTIFIKASI,
                ]);
            }

            $this->resetForm();
            return redirect(route('masuk'));
        }catch(\Exception $e){

              $this->dispatchBrowserEvent('swal',[
                  'icon'=>'error',
                  'title'=>$this::DAFTAR_NOTIFIKASI_GAGAL
            ]);
            $this->resetForm();
            return redirect()->back();
        }

    }
        

    public function render()
    {
        return view('livewire.front.daftar-livewire')->layout('layouts.pagesloginregister');
    }
}
