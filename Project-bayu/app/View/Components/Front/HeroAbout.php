<?php

namespace App\View\Components\Front;

use App\Models\Admin\Abouts;
use Illuminate\View\Component;

class HeroAbout extends Component
{
    public $about;
    public function __construct()
    {
        $this->about = Abouts::where('id', 1)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.hero-about');
    }
}
