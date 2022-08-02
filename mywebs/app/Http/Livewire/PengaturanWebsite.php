<?php

namespace App\Http\Livewire;

use App\Models\PengaturanWeb;
use Livewire\Component;

class PengaturanWebsite extends Component
{
    public $pengaturan_id, $nama_website, $url_facebook, $url_youtube, $url_instagram, $deskripsi, $email,$nomor_hp;
    public $updatePengaturan;

    public function mount(){
        $pengaturan = PengaturanWeb::where('id',1)->first();
        $this->pengaturan_id = $pengaturan->id;
        $this->nama_website = $pengaturan->nama_website;
        $this->url_facebook = $pengaturan->url_facebook;
        $this->url_youtube = $pengaturan->url_youtube;
        $this->url_instagram = $pengaturan->url_instagram;
        $this->deskripsi = $pengaturan->deskripsi;
        $this->email = $pengaturan->email;
        $this->nomor_hp = $pengaturan->nomor_hp;
    }
    public function render()
    {
        $pengaturan = PengaturanWeb::where('id' ,1)->first();
        return view('livewire.pengaturan-website',[
            'pengaturan'=> $pengaturan
        ]);
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
            $pengaturan = PengaturanWeb::find($this->pengaturan_id);
            $pengaturan->update([
                'nama_website'  => $this->nama_website,
                'url_facebook'  => $this->url_facebook,
                'url_instagram' => $this->url_instagram,
                'url_youtube'   => $this->url_youtube,
                'deskripsi'     => $this->deskripsi,
                'email'         => $this->email,
                'nomor_hp'      => $this->nomor_hp,
            ]);
            $pengaturan->save();
            session()->flash('message', 'Pengaturan berhasil di perbaharui!',array('timeout' => 1000), 'error');
        }
    }
}
