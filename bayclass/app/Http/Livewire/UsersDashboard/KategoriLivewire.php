<?php

namespace App\Http\Livewire\UsersDashboard;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use App\Models\Backend\KategoriKelas;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Backend\KategoriKelasResources;

class KategoriLivewire extends Component
{
    public function render()
    {
        $kategori = KategoriKelasResources::collection(
            KategoriKelas::orderBy('created_at', 'desc')->where('status', 1)->get()->toArray()
        );

        $array = [];
        foreach ($kategori as $key => $value) {
            $array[$key]['id'] = $value['id'];
            $array[$key]['nama_kategori'] = $value['nama_kategori'];
            $array[$key]['status'] = $value['status'];
        }

        $myCollectionObj = collect($array);

        $kategori = $this->paginate($myCollectionObj);
        return view('livewire.users-dashboard.kategori-livewire',[
            'kategoriKelas' => $kategori
        ])->layout('layouts.pagesusers');
    }

    public function paginate($items, $perPage = 8, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
}
