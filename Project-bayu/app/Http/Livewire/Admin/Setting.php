<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Admin\Settings;
use Illuminate\Support\Facades\File;

class Setting extends Component
{
    use WithFileUploads;
    public $images, $old_images, $icon, $old_icon;
    public $setting_id, $address, $name_website, $description, $email, $tiktok, $instagram, $facebook, $linkedin, $phone;
    public $setting;
    public function mount()
    {
        $setting = Settings::where('id', 1)->first();
        $this->setting_id = $setting->id;
        $this->name_website = $setting->name_website;
        $this->description = $setting->description;
        $this->tiktok = $setting->tiktok;
        $this->instagram = $setting->instagram;
        $this->facebook = $setting->facebook;
        $this->email = $setting->email;
        $this->linkedin = $setting->linkedin;
        $this->address = $setting->address;
        $this->phone = $setting->phone;
        $this->images = $setting->images;
        $this->icon = $setting->icon;
    }

    public function SettingsUpdate()
    {
        $ImagesValidation = '';
        if ($this->images != $this->old_images) {
            $ImagesValidation = 'nullable|image|mimes:jpg,png,svg|max:2048';
        }
        $IconValidation = '';
        if ($this->icon != $this->old_icon) {
            $IconValidation = 'nullable|image|mimes:jpg,png,svg|max:2048';
        }
        $this->validate([
            'name_website'  => 'required',
            'description'  => 'nullable',
            'tiktok' => 'nullable',
            'instagram'   => 'nullable',
            'facebook'     => 'nullable',
            'linkedin'     => 'nullable',
            'address'     => 'nullable',
            'email'         => 'nullable|email',
            'phone'      => 'nullable|numeric|digits_between:11,15',
            'images'    => $ImagesValidation,
            'icon'    => $IconValidation
        ]);

        if ($this->images != $this->old_images) {
            $fileimages = public_path('\storage\\') . $this->images;
            if (File::exists($fileimages)) {
                File::delete($fileimages);
            }
            $fileGambar = 'images-' . time() . $this->images->getClientOriginalName();

            $this->images->storeAs('logo', $fileGambar);
            // $fileGambar = $this->images->storeAs('project' , 'public');
        } else {
            $fileGambar = $this->images;
        }
        if ($this->icon) {
            $fileimages1 = public_path('\storage\\') . $this->icon;
            if (File::exists($fileimages1)) {
                File::delete($fileimages1);
            }
            $fileGambar1 = $this->icon->storeAs('icon', 'public');

            // $this->icon->storeAs('icon', 'public');
        } else {
            $fileGambar1 = $this->icon;
        }

        if ($this->setting_id) {
            $settings = Settings::find($this->setting_id);
            $settings->update([
                'name_website'  => $this->name_website,
                'description'  => $this->description,
                'tiktok' => $this->tiktok,
                'instagram'   => $this->instagram,
                'facebook'     => $this->facebook,
                'linkedin'     => $this->linkedin,
                'address'     => $this->address,
                'email'         => $this->email,
                'phone'      => $this->phone,
                'images'    => $fileGambar,
                'icon'    => $fileGambar1,
            ]);



            $settings->save();
            session()->flash('message', 'Settings Updated Successfully!', array('timeout' => 1000), 'error');
        }
    }
    public function render()
    {
        return view('livewire.admin.setting');
    }
}
