<?php

namespace App\Http\Livewire\UsersDashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use App\Models\Backend\PilihanKelas;
use Illuminate\Pagination\Paginator;
use App\Models\Backend\KategoriKelas;
use Illuminate\Pagination\LengthAwarePaginator;

class PilihanKelasLivewire extends Component
{
    // public $paginate = 5;
    public const TELAH_PILIH_KELAS = 'Berhasil memilih kelas';
    public const KELAS_SUDAH_DI_PILIH = 'Kelas sudah dipilih';
    use WithPagination;
    public $validasiPilih = '';
    public $konfirmasiValidasi;

    public $array_kelas = [];
    public function render()
    {
        $kelas = PilihanKelas::query()->whereNull('deleted_at')->where('status', '=', '1')
        ->get();

        $array_kelas = [];
        foreach ($kelas as $key => $value) {
            $pilihanKelas = PilihanKelas::query()->where('id', '=', $value['id'])->paginate(5);
            $array_kelas[$key] = $pilihanKelas;
            $kategoriKelas = KategoriKelas::query()->where('id', '=', $value['kategorikelas_id'])->first();
            $userKelas = User::query()->where('id', '=', $value['user_id'])->first();
            $userPilih = User::query()->where('id', '=', $value['dipilih_user_id'])->first();
            $array_kelas[$key]['id'] = $value['id'];
            $array_kelas[$key]['nama_kelas'] = $value['nama_kelas'];
            $array_kelas[$key]['gambar_kelas'] = $value['gambar_kelas'];
            $array_kelas[$key]['deskripsi_kelas'] = $value['deskripsi_kelas'];
            if($array_kelas[$key]['harga_kelas'] = $value['harga_kelas'] == 0){
                $array_kelas[$key]['harga_kelas'] = 'Gratis';
            }else{
                $array_kelas[$key]['harga_kelas'] = 'Rp. '.number_format($value['harga_kelas'], 0, ',', '.');
            }
            $array_kelas[$key]['dipilih_user_id'] = $value['dipilih_user_id'];
            $array_kelas[$key]['status'] = $value['status'];
            $array_kelas[$key]['nama_kategori'] = 'Kategori : '.$kategoriKelas->nama_kategori;
            $array_kelas[$key]['nama_user'] = 'Nama Pembuat : '.$userKelas->name;
        }
        $myCollectionObj = collect($array_kelas);



        $array = $this->paginate($myCollectionObj);
        return view('livewire.users-dashboard.pilihan-kelas-livewire',
        [
            'kelas' => $array
        ])->layout('layouts.pagesusers');
    }

    public function validasiPilih($id)
    {
        $this->konfirmasiValidasi = $id;
        dd($this->konfirmasiValidasi);

    }

    public function pilihKelas($id){
        $pilihanKelas = PilihanKelas::query()->where('id', '=', $id)->first();
        $user = User::query()->where('id', '=', $pilihanKelas['user_id'])->first();
        $userPilih = User::query()->where('id', '=', $pilihanKelas['dipilih_user_id'])->first();
        if($pilihanKelas['dipilih_user_id'] == null){
            $pilihanKelas->dipilih_user_id = auth()->user()->id;
            $pilihanKelas->save();
            $this->validasiPilih = self::TELAH_PILIH_KELAS;
            $this->dispatchBrowserEvent('swal',[
            'title' => $this::TELAH_PILIH_KELAS . $pilihanKelas->nama_kelas,
            'icon'=> 'success'
            ]);
        }

        // $pilihanKelas = PilihanKelas::find($this->validasiPilih);

        // if($pilihanKelas->dipilih_user_id == null){
        //     $pilihanKelas->dipilih_user_id = auth()->user()->id;
        //     $pilihanKelas->save();
        //      $this->dispatchBrowserEvent('swal',[
        //     'title' => $this::TELAH_PILIH_KELAS . $pilihanKelas->nama_kelas,
        //     'icon'=> 'success'
        //     ]);
        // }else{
        //     $this->validasiPilih = '';
        //     $this->konfirmasiValidasi = '';
        //     $this->dispatchBrowserEvent('swal',[
        //     'title' => $this::KELAS_SUDAH_DI_PILIH . $pilihanKelas->nama_kelas,
        //     'icon'=> 'error',
        //     ]);
        // }
        // $pilihanKelas->dipilih_user_id = auth()->user()->id;
        // $pilihanKelas->save();
       
    }

    // public function pilihKelas($id)
    // {
    //     $pilihanKelas = PilihanKelas::query()->where('id', '=', $id)->first();
    //     $pilihanKelas->dipilih_user_id = auth()->user()->id;
    //     // dd('telah dipilh');
    //     $pilihanKelas->save();
    //     $this->dispatchBrowserEvent('swal',[
    //     'title' => $this::TELAH_PILIH_KELAS . $pilihanKelas->nama_kelas,
    //     'icon'=> 'success'
    //     ]);
    // }

    public function paginate($items, $perPage = 8, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
}
