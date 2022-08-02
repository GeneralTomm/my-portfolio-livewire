<?php

namespace App\Http\Livewire\BackEnd;

use App\Models\Backend\Setting as BackendSetting;
use Livewire\Component;

class Setting extends Component
{
    public $pengaturan_id, $nama_website, $url_facebook, $url_youtube, $url_instagram, $deskripsi, $email,$nomor_hp;
    public $updatePengaturan;

    public function mount(){
        $settings = BackendSetting::where('id',1)->first();
        $this->pengaturan_id = $settings->id;
        $this->nama_website = $settings->nama_website;
        $this->url_facebook = $settings->url_facebook;
        $this->url_youtube = $settings->url_youtube;
        $this->url_instagram = $settings->url_instagram;
        $this->deskripsi = $settings->deskripsi;
        $this->email = $settings->email;
        $this->nomor_hp = $settings->nomor_hp;
    }
    public function render()
    {
        $settings = BackendSetting::where('id' ,1)->first();
        return view('livewire.back-end.setting',
        [
            'settings'  => $settings
        ])
        ->layout('layouts.app');
    }

    public function updatePengaturan(){
        $this->validate([
            'nama_website'  => 'required',
            'url_facebook'  => 'required',
            'url_instagram' => 'required',
            'url_youtube'   => 'required',
            'deskripsi'     => 'required',
            'email'         => 'required|email',
            'nomor_hp'      => 'required|numeric|digits_between:11,15',
        ]);

        if($this->pengaturan_id){
            $settings = BackendSetting::find($this->pengaturan_id);
            $settings->update([
                'nama_website'  => $this->nama_website,
                'url_facebook'  => $this->url_facebook,
                'url_instagram' => $this->url_instagram,
                'url_youtube'   => $this->url_youtube,
                'deskripsi'     => $this->deskripsi,
                'email'         => $this->email,
                'nomor_hp'      => $this->nomor_hp,
            ]);
            $settings->save();
            $this->emit('namaChanged', $this->nama_website);
            session()->flash('message', 'Pengaturan berhasil di perbaharui!',array('timeout' => 1000), 'error');
        }
    }
}
