<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Abouts;
use App\Models\Admin\Projects;
use App\Models\Admin\Services;
use App\Models\Admin\Settings;
use App\Models\Admin\OrderSteps;
use App\Models\Admin\Testimonials;
use App\Models\Admin\CategoriesProjects;

class Dashboard extends Component
{
    public $project, $service, $categories_project, $order, $categories_blog, $blog, $about, $settings, $testimonial;
    public $dashboard;
    public function mount()
    {

        // $this->dashboard = Dash::with(['project'])->get();
        $this->project = Projects::all();
        $this->service = Services::where('status', 'active')->get();
        $this->order = OrderSteps::all();

        $this->about = Abouts::all();
        $this->settings = Settings::all();
        $this->testimonial = Testimonials::all();
        $this->categories_project = CategoriesProjects::all();
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
