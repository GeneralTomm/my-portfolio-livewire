<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function laporanPendapatan($tahun){
        $utama = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            where('menu.kategori_menu', '=', 'Utama')->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();

        $sideDish = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            where('menu.kategori_menu', '=', 'Side Dish')->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();               
                            
        $minuman = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            where('menu.kategori_menu', '=', 'Minuman')->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();

        $totalPendapatan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();                                    

    }

    public function laporanPendapatanMakanan($tahun){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            where('menu.kategori_menu', '=', 'Utama')->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function laporanPendapatanSideDish($tahun){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            where('menu.kategori_menu', '=', 'Side Dish')->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function laporanPendapatanMinuman($tahun){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            where('menu.kategori_menu', '=', 'Minuman')->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function totalPendapatan($tahun){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereYear('transaksi.tgl_transaksi', '=', $tahun)->
                            select(DB::raw("MONTHNAME(transaksi.tgl_transaksi) month") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('month') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function laporanPendapatanMakananTahunan($tahun1, $tahun2){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereBetween(DB::raw('YEAR(transaksi.tgl_transaksi)'), array($tahun1, $tahun2))->
                            where('menu.kategori_menu', '=', 'Utama')->
                            select(DB::raw("YEAR(transaksi.tgl_transaksi) year") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('year') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function laporanPendapatanSideDishTahunan($tahun1, $tahun2){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereBetween(DB::raw('YEAR(transaksi.tgl_transaksi)'), array($tahun1, $tahun2))->
                            where('menu.kategori_menu', '=', 'Side Dish')->
                            select(DB::raw("YEAR(transaksi.tgl_transaksi) year") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('year') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function laporanPendapatanMinumanTahunan($tahun1, $tahun2){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereBetween(DB::raw('YEAR(transaksi.tgl_transaksi)'), array($tahun1, $tahun2))->
                            where('menu.kategori_menu', '=', 'Minuman')->
                            select(DB::raw("YEAR(transaksi.tgl_transaksi) year") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('year') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    public function totalPendapatanTahunan($tahun1, $tahun2){
        $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
                            join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
                            join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
                            join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
                            join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
                            join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
                            whereBetween(DB::raw('YEAR(transaksi.tgl_transaksi)'), array($tahun1, $tahun2))->
                            select(DB::raw("YEAR(transaksi.tgl_transaksi) year") , DB::raw('sum(detail_pesanan.jumlah_item_pesanan * menu.harga_menu)AS Sub_Total'))->
                            groupBy('year') -> get();


        if(!is_null($pesanan)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data'  => $pesanan
            ],200);
        }       
        
        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    // public function laporanPengeluaranMakanan($tahun){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereYear('histori_stok.tanggal_masuk', '=', $tahun)->
    //                         where('menu.kategori_menu', '=', 'Utama')->
    //                         select(DB::raw("MONTHNAME(histori_stok.tanggal_masuk) month") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('month') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPengeluaranSideDish($tahun){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereYear('histori_stok.tanggal_masuk', '=', $tahun)->
    //                         where('menu.kategori_menu', '=', 'Side Dish')->
    //                         select(DB::raw("MONTHNAME(histori_stok.tanggal_masuk) month") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('month') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPengeluaranMinuman($tahun){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereYear('histori_stok.tanggal_masuk', '=', $tahun)->
    //                         where('menu.kategori_menu', '=', 'Minuman')->
    //                         select(DB::raw("MONTHNAME(histori_stok.tanggal_masuk) month") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('month') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function totalPengeluaran($tahun){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereYear('histori_stok.tanggal_masuk', '=', $tahun)->
    //                         select(DB::raw("MONTHNAME(histori_stok.tanggal_masuk) month") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('month') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPengeluaranMakananTahunan($tahun1, $tahun2){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereBetween(DB::raw('YEAR(histori_stok.tanggal_masuk)'), array($tahun1, $tahun2))->
    //                         where('menu.kategori_menu', '=', 'Utama')->
    //                         select(DB::raw("YEAR(histori_stok.tanggal_masuk) year") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('year') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }


    // public function laporanPengeluaranSideDishTahunan($tahun1, $tahun2){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereBetween(DB::raw('YEAR(histori_stok.tanggal_masuk)'), array($tahun1, $tahun2))->
    //                         where('menu.kategori_menu', '=', 'Side Dish')->
    //                         select(DB::raw("YEAR(histori_stok.tanggal_masuk) year") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('year') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPengeluaranMinumanTahunan($tahun1, $tahun2){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereBetween(DB::raw('YEAR(histori_stok.tanggal_masuk)'), array($tahun1, $tahun2))->
    //                         where('menu.kategori_menu', '=', 'Minuman')->
    //                         select(DB::raw("YEAR(histori_stok.tanggal_masuk) year") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('year') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function totalPengeluaranTahunan($tahun1, $tahun2){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         whereBetween(DB::raw('YEAR(histori_stok.tanggal_masuk)'), array($tahun1, $tahun2))->
    //                         select(DB::raw("YEAR(histori_stok.tanggal_masuk) year") , DB::raw('sum(stok_bahan.harga_stok * menu.harga_menu)AS Sub_Total'))->
    //                         groupBy('year') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPenjualanMakananPerBulan($tahun, $bulan){
    //     $pesanan = DB::table('pesanan')->join('reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
    //                         join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
    //                         join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         whereYear('transaksi.tgl_transaksi', '=', $tahun)->
    //                         whereMonth('transaksi.tgl_transaksi', '=', $bulan)->
    //                         where('menu.kategori_menu', '=', 'Utama')->
    //                         select(DB::raw('max(detail_pesanan.jumlah_item_pesanan) as kuantitas_max' ),
    //                         DB::raw('sum(detail_pesanan.jumlah_item_pesanan) AS Total'), 'menu.nama_menu', 'menu.unit_menu')->
    //                         groupBy('menu.nama_menu', 'menu.unit_menu') -> get();


    //     if(!is_null($pesanan)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $pesanan
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPenjualanSideDishPerBulan($tahun, $bulan){
    //     $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
    //                         join('bahan' , 'bahan.id_bahan', '=' ,'menu.id_bahan') ->
    //                         join('stok_bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         whereYear('transaksi.tgl_transaksi', '=', $tahun)->
    //                         whereMonth('transaksi.tgl_transaksi', '=', $bulan)->
    //                         where('menu.kategori_menu', '=', 'Side Dish')->
    //                         select(DB::raw('max(detail_pesanan.jumlah_item_pesanan) as kuantitas_max' ),
    //                         DB::raw('sum(detail_pesanan.jumlah_item_pesanan) AS Total'), 'menu.nama_menu', 'menu.unit_menu')->
    //                         groupBy('menu.nama_menu', 'menu.unit_menu') -> get();


    //     if(!is_null($pesanan)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $pesanan
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPenjualanMinumanPerBulan($tahun, $bulan){
    //     $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
    //                         join('bahan' , 'bahan.id_bahan', '=' ,'menu.id_bahan') ->
    //                         join('stok_bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         whereYear('transaksi.tgl_transaksi', '=', $tahun)->
    //                         whereMonth('transaksi.tgl_transaksi', '=', $bulan)->
    //                         where('menu.kategori_menu', '=', 'Minuman')->
    //                         select(DB::raw('max(detail_pesanan.jumlah_item_pesanan) as kuantitas_max' ),
    //                         DB::raw('sum(detail_pesanan.jumlah_item_pesanan) AS Total'), 'menu.nama_menu', 'menu.unit_menu')->
    //                         groupBy('menu.nama_menu', 'menu.unit_menu') -> get();


    //     if(!is_null($pesanan)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $pesanan
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPenjualanMakananPerTahun($tahun){
    //     $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
    //                         join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
    //                         join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         whereYear('transaksi.tgl_transaksi', '=', $tahun)->
    //                         where('menu.kategori_menu', '=', 'Utama')->
    //                         select(DB::raw('max(detail_pesanan.jumlah_item_pesanan) as kuantitas_max' ),
    //                         DB::raw('sum(detail_pesanan.jumlah_item_pesanan) AS Total'), 'menu.nama_menu', 'menu.unit_menu')->
    //                         groupBy('menu.nama_menu', 'menu.unit_menu') -> get();


    //     if(!is_null($pesanan)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $pesanan
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPenjualanSideDishPerTahun($tahun){
    //     $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
    //                         join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
    //                         join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         whereYear('transaksi.tgl_transaksi', '=', $tahun)->
    //                         where('menu.kategori_menu', '=', 'Side Dish')->
    //                         select(DB::raw('max(detail_pesanan.jumlah_item_pesanan) as kuantitas_max' ),
    //                         DB::raw('sum(detail_pesanan.jumlah_item_pesanan) AS Total'), 'menu.nama_menu', 'menu.unit_menu')->
    //                         groupBy('menu.nama_menu', 'menu.unit_menu') -> get();


    //     if(!is_null($pesanan)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $pesanan
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanPenjualanMinumanPerTahun($tahun){
    //     $pesanan = DB::table('pesanan')->join('Reservasi' , 'pesanan.id_reservasi', '=' , 'reservasi.id_reservasi') ->
    //                         join( 'meja' , 'reservasi.id_meja', '=' ,'meja.id_meja') ->
    //                         join('customer' , 'reservasi.id_customer', '=' ,'customer.id_customer') ->
    //                         join('detail_pesanan' , 'detail_pesanan.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         join('menu' , 'menu.id_menu', '=' ,'detail_pesanan.id_menu') ->
    //                         join('stok_bahan' , 'stok_bahan.id_bahan', '=' ,'menu.id_bahan') ->
    //                         join('transaksi' , 'transaksi.id_pesanan', '=' ,'pesanan.id_pesanan') ->
    //                         whereYear('transaksi.tgl_transaksi', '=', $tahun)->
    //                         where('menu.kategori_menu', '=', 'Minuman')->
    //                         select(DB::raw('max(detail_pesanan.jumlah_item_pesanan) as kuantitas_max' ),
    //                         DB::raw('sum(detail_pesanan.jumlah_item_pesanan) AS Total'), 'menu.nama_menu', 'menu.unit_menu')->
    //                         groupBy('menu.nama_menu', 'menu.unit_menu') -> get();


    //     if(!is_null($pesanan)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $pesanan
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanStokSatuMenu($menu,$tahun,$bulan){
    //     // $histori = DB::table('histori_stok')->join('stok_bahan' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //     //                     join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //     //                     join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //     //                     where('menu.nama_menu', '=', $menu)->
    //     //                     whereYear('histori_stok.tanggal_masuk', '=', $tahun)->
    //     //                     // ORwhereYear('histori_stok.tanggal_keluar', '=', $tahun)->
    //     //                     // ORwhereYear('histori_stok.tanggal_terbuang_stok', '=', $tahun)->
    //     //                     whereMonth('histori_stok.tanggal_masuk', '=', $bulan)->
    //     //                     select(  DB::raw('DATE_FORMAT(histori_stok.tanggal_masuk, "%d %M %Y") as Tanggal' ), 
    //     //                     DB::raw('sum(histori_stok.jumlah_masuk_stok) as stok_masuk') , 
    //     //                     DB::raw('sum(histori_stok.jumlah_stok_habis) as stok_habis') , 
    //     //                     DB::raw('sum(histori_stok.jumlah_stok_terbuang) as stok_terbuang'))->
    //     //                     groupBy('Tanggal') -> get();

    //     $histori = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_stok') ->
    //                         where('menu.nama_menu', '=', $menu)->
    //                         whereYear('histori_stok.tanggal_masuk', '=', $tahun)->
    //                         whereMonth('histori_stok.tanggal_masuk', '=', $bulan)->
    //                         select(  'menu.nama_menu', DB::raw('DATE_FORMAT(histori_stok.tanggal_masuk, "%d %M %Y") as Tanggal' ), 
    //                         DB::raw('sum(histori_stok.jumlah_masuk_stok) as stok_masuk') , 
    //                          DB::raw('sum(histori_stok.jumlah_stok_habis) as stok_habis') , 
    //                         DB::raw('sum(histori_stok.jumlah_stok_terbuang) as stok_terbuang'))->
    //                         get();
                    


    //     if(!is_null($histori)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $histori
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

    // public function laporanStokMakanan($tanggal, $tanggal2){
    //     $stok = DB::table('stok_bahan')->join('bahan' , 'bahan.id_bahan', '=' ,'stok_bahan.id_bahan') ->
    //                         join('menu' , 'menu.id_bahan', '=' ,'bahan.id_bahan') ->
    //                         join('histori_stok' , 'histori_stok.idStok', '=' ,'stok_bahan.id_bahan') ->
    //                         where('menu.kategori_menu', '=', 'Utama')-> 
    //                         whereBetween('histori_stok.tanggal_masuk', [$tanggal,$tanggal2]) ->
    //                         select('menu.nama_menu', 'stok_bahan.unit_stok',   
    //                         DB::raw('sum(histori_stok.jumlah_masuk_stok) as stok_masuk') , 
    //                         DB::raw('sum(histori_stok.jumlah_stok_habis) as stok_habis') , 
    //                         DB::raw('sum(histori_stok.jumlah_stok_terbuang) as stok_terbuang'))->
    //                         groupBy('Tanggal') -> get();


    //     if(!is_null($stok)>0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data'  => $stok
    //         ],200);
    //     }       
        
    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 404);
    // }

}
