<?php

namespace App\Http\Livewire\UsersDashboard;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class PengaturanLivewire extends Component
{

    public $user, $name , $password ,$email ,$nomor_hp;

    public const PERBAHARUI_NOTIFIKASI_BERHASIL = 'Berhasil perbaharui data dengan datamu!';
    public const PERBAHARUI_NOTIFIKASI_GAGAL = 'Gagal perbaharui data dengan datamu!';
    public function mount(){
        
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->nomor_hp = $this->user->nomor_hp;
    }

    public function resetData(){
        $this->password = '';
    }

    protected $rules = 
    [
        'name' => 'required',
        'nomor_hp' => 'required|regex:/(08)[0-9]/|not_regex:/[a-z]/|min:11|max:15',
        'password' => 'nullable|min:6',
    ];

    public function perbaharuiUsers(){

        $this->validate();

        $user = User::find($this->user->id);

        $user->name = $this->name;
        $user->nomor_hp = $this->nomor_hp;

        if($this->password){
            $user->password = Hash::make($this->password);
        }
        $user->save();

        if($user->save()){
            $this->dispatchBrowserEvent('swal',[
            'title' => $this::PERBAHARUI_NOTIFIKASI_BERHASIL,
            'icon'=> 'success'
            ]);
            $this->resetData();

        }else{
            $this->dispatchBrowserEvent('swal',[
            'title' => $this::PERBAHARUI_NOTIFIKASI_GAGAL,
            'icon'=> 'success'
            ]);
        }

        return redirect(route('pengaturan'));


    }
    public function render()
    {
        return view('livewire.users-dashboard.pengaturan-livewire')->layout('layouts.pagesusers');
    }
}
