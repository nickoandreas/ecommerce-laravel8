<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Rajaongkir_model extends Model
{
    public function provinsi() {

        $curl = curl_init();
  
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
           "key: 373a4fb631ac669647f27d058c621cd1"
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
        echo "cURL Error #:" . $err;
        } 
        else {
           $response = json_decode($response, true);
           return $provinsi = $response['rajaongkir']['results'];
        }
  
    }

    public function tambah_pengiriman()
    {
        $data = [
            'id_pelanggan'      => session('id_pelanggan'),
            'kode_transaksi'    => request()->input('kode_transaksi'),
            'expedisi'          => request()->input('expedisi'),
            'layanan'           => request()->input('layanan'),
            'id_tujuan'         => request()->input('id_tujuan'),
            'provinsi'          => request()->input('provinsi'),
            'kota'              => request()->input('kota'),
            'alamat'            => request()->input('alamat'),
            'berat'             => request()->input('berat'),
            'ongkir'            => request()->input('ongkir')
        ];
        DB::table('pengiriman')->insert($data);
    }
}
