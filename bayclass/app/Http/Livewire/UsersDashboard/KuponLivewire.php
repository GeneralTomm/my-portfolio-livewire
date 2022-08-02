<?php

namespace App\Http\Livewire\UsersDashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Backend\KuponCode;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Backend\KuponCodeResources;

class KuponLivewire extends Component
{

    public $paginate = 5;
    use WithPagination;
    public function updatingPagination(){
        $this->resetPage();
    }
    public function render()
    {
        $kuponCode = KuponCodeResources::collection(
            KuponCode::query()->orderBy('created_at','desc')->where('status', 1)->get()->toArray()
        );

        $array = [];

        foreach ($kuponCode as $key => $value) {
            $array[$key]['id'] = $value['id'];
            $array[$key]['nama_kupon'] = $value['nama_kupon'];
            $array[$key]['kode_kupon'] = $value['kode_kupon'];
        }

        $myCollectionObj = collect($array);

        $kuponCode = $this->paginate($myCollectionObj);
        // dd($kuponCode);
        return view('livewire.users-dashboard.kupon-livewire',[
            'kuponCode' => $kuponCode
        ])->layout('layouts.pagesusers');
    }

     public function paginate($items, $perPage = 8, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
}
