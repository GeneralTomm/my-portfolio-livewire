<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Settings;

class Setting extends Component
{
    public $settings_id, $name_website, $description, $email, $phone, $address;

    public function mount(){
        $setting = Settings::where('id', 1)->first();
        $this->name_website = $setting->name_website;
        $this->email = $setting->email;
        $this->description = $setting->description;
        $this->phone = $setting->phone;
        $this->address = $setting->address;
    }

    public function updateSettings(){
        $this->validate([
            'name_website'  => 'required',
            'email'         => 'required',
            'description'   => 'required',
            'phone'         => 'required',
            'address'       => 'required',
        ]);

        if($this->settings_id){
            $settings = Settings::find($this->settings_id);
            $settings->update([
                'name_website'  => $this->name_website,
                'email'  => $this->email,
                'description' => $this->description,
                'phone'   => $this->phone,
                'address'     => $this->address,
            ]);
            $settings->save();
            session()->flash('message', 'Pengaturan berhasil di perbaharui!',array('timeout' => 1000), 'error');
        }
    }

    public function render()
    {
        $settings = Settings::where('id',1)->first();
        return view('livewire.admin.setting',
    [
        'settings' => $settings,
    ]);
    }
}
