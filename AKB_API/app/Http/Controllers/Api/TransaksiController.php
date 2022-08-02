<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Transaksi;
use App\DetailTransaksi;
use App\Pesanan;
use Carbon\Carbon;
use DB;
use PDF;

class TransaksiController extends Controller
{
    // SHOW ALL
    public function index(){
        $transaksi = Transaksi::all();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    // SHOW ALL CUSTOM
    public function indexCustom(){
        $transaksi = Transaksi::join('pesanan', 'transaksi.id_pesanan', '=', 'pesanan.id_pesanan')
            ->join('reservasi', 'pesanan.id_reservasi', '=', 'reservasi.id_reservasi')
            ->join('customer', 'reservasi.id_customer', '=', 'customer.id_customer')
            ->join('karyawan', 'reservasi.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
            ->select('customer.nama_customer','karyawan.nama_karyawan', 'pesanan.total_harga', 'transaksi.*','pesanan.*','meja.no_meja')
            ->get();
        
        $namaCashier = Transaksi::join('karyawan', 'transaksi.id_karyawan', '=', 'karyawan.id_karyawan')
            ->select('karyawan.nama_karyawan')
            ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'dataTransaksi' => $transaksi,
                'namaCashier' => $namaCashier
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    // CREATE
    public function store(Request $request)
    {
        $transaksi = new Transaksi;
        $pesanan = new Pesanan;
        $transaksi -> id_karyawan = $request['id_karyawan'];
        $transaksi -> id_pesanan = $request['id_pesanan'];
        $transaksi -> jenis_pembayaran = $request['jenis_pembayaran'];
        $transaksi -> no_transaksi = $this->cetakNomorTransaksi();
        $transaksi -> tgl_transaksi = Carbon::now();
        $transaksi -> waktu_transaksi = Carbon::now();
        $transaksi -> jumlah_bayar = $request['jumlah_bayar'];

        if($transaksi->jumlah_bayar < $pesanan->total_harga)
        {
            return response(['message' => 'Maaf Jumlah Bayar Kurang',
            'status' => 'Error'],400);

        }
        else
        {
            try{
                $success = $transaksi->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'data' => $transaksi
                ];
                $detail_transaksi = new DetailTransaksi;
                $detail_transaksi = DB::table('detail_transaksi')
                ->insert([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'nama_pemilik' => $request['nama_pemilik'],
                    'no_kartu' => $request['no_kartu'],
                    'kode_verifikasi' => $this->cetakKodeVerifikasi($request['jenis_pembayaran']),
                ]);
                
            }

            catch(\Illuminate\Database\QueryException $e){
                $status = 500;
                $response = [
                    'status' => 'Error',
                    'data' => [],
                    'message' => $e
                ];
            }
            return response()->json($response,$status);
        }

        
        
    }

    // UPDATE
    public function update(Request $request, $id){
        $transaksi = Transaksi::find($id);
        if(is_null($transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_pesanan' => 'required|numeric',
            'id_karyawan' => 'required|numeric',
            'nomor_transaksi' => 'required',
            'tgl_transaksi' => 'required|date_format:Y-m-d',
            'waktu_transaksi' => 'required',
            'jenis_pembayaran_transaksi' => 'required',
            'nomor_kartu_transaksi' => 'nullable|numeric',
            'nama_credit_transaksi' => 'nullable',
            'kode_verifikasi_transaksi' => 'nullable',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $transaksi->id_pesanan = $updateData['id_pesanan'];
        $transaksi->id_karyawan = $updateData['id_karyawan'];
        $transaksi->nomor_transaksi = $updateData['nomor_transaksi'];
        $transaksi->tgl_transaksi = $updateData['tgl_transaksi'];
        $transaksi->waktu_transaksi = $updateData['waktu_transaksi'];
        $transaksi->jenis_pembayaran_transaksi = $updateData['jenis_pembayaran_transaksi'];
        if(!empty($updateData['nomor_kartu_transaksi'])){
            $transaksi->nomor_kartu_transaksi = $updateData['nomor_kartu_transaksi'];
        } else {
            $transaksi->nomor_kartu_transaksi = null;
        }
            
        if(!empty($updateData['nama_credit_transaksi'])) {
            $transaksi->nama_credit_transaksi = $updateData['nama_credit_transaksi'];
        } else {
            $transaksi->nama_credit_transaksi = null;
        }

        if(!empty($updateData['kode_verifikasi_transaksi'])) {
            $transaksi->kode_verifikasi_transaksi = $updateData['kode_verifikasi_transaksi'];
        } else {
            $transaksi->kode_verifikasi_transaksi = null;
        }

        if($transaksi->save()){
            return response([
                'message' => 'Update Transaksi Success',
                'data' => $transaksi,
            ], 200);
        }
        
        return response([
            'message' => 'Update Transaksi Failed',
            'data' => null
        ], 400);
    }

    // DELETE
    public function destroy($id){
        $transaksi = Transaksi::find($id);

        if(is_null($transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ], 404);
        }

        if($transaksi->delete()){
            return response([
                'message' => 'Delete Transaksi Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Delete Transaksi Failed',
            'data' => null
        ], 400);
    }

    public function getStrukInfo($idTransaksi) {
        $transaksi = Transaksi::join('pesanan', 'transaksi.id_pesanan', '=', 'pesanan.id_pesanan')
            ->join('reservasi', 'pesanan.id_reservasi', '=', 'reservasi.id_reservasi')
            ->join('karyawan', 'reservasi.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
            ->join('customer', 'reservasi.id_customer', '=', 'customer.id_customer')
            ->select('*')
            ->where('transaksi.id_transaksi', '=', $idTransaksi)
            ->first();

        return response([
            'message' => 'Get Struk Info Success',
            'data' => $transaksi
        ], 200);
    }

    public function cetakNomorTransaksi()
    {
        $transaksi = new Transaksi;
        $today = Carbon::now();
        $tempNomor = Transaksi::where('tgl_transaksi', $today)->get();
        if(isset($transaksi))
        {
            $nomor = $tempNomor->count()+1;
            if($nomor<9)
            {
                return 'AKB-'.date('dmy').'-'.'0'.($nomor+1);
            }
            else
            {
                return 'AKB-'.date('dmy').'-'.($nomor+1);
            }
        }
        else
        {
            return 'AKB-'.date('dmy').'-'.'01';   
        }
        
    }

    public function cetakKodeVerifikasi($jenis_pembayaran)
    {
        $informasi_pembayaran = Transaksi::where('jenis_pembayaran', $jenis_pembayaran)->first();
        $tempKode = Transaksi::where('jenis_pembayaran', $jenis_pembayaran)->get();
        if($jenis_pembayaran=='Debit')
        {
            if(isset($informasi_pembayaran))
            {
                $kode = $tempKode->count()+1;
                if($kode<9)
                {
                    return 'DBT-'.date('dmy').'-0'.($kode+1);
                }
                else
                {
                    return 'DBT-'.date('dmy').'-'.($kode+1);
                }
            }
            else
            {
                return 'DBT-'.date('dmy').'-'.'01';
            }
        }
        else if($jenis_pembayaran=='Credit')
        {
            if(isset($informasi_pembayaran))
            {
                $kode = $tempKode->count()+1;
                if($kode<9)
                {
                    return 'CDT-'.date('dmy').'-0'.($kode+1);
                }
                else
                {
                    return 'CDT-'.date('dmy').'-'.($kode+1);
                }
            }
            else
            {
                return 'CDT-'.date('dmy').'-'.'01';
            }
                
        }
    }
}
