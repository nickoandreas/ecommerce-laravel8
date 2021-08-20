<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Transaksi_model extends Model
{   
    public function listingByKode($kode_transaksi)
    {
        return DB::table('produk')
                    ->leftJoin('transaksi', 'transaksi.id_produk', '=', 'produk.id_produk')
                    ->select('transaksi.*', 'produk.*')
                    ->where('kode_transaksi', $kode_transaksi)
                    ->get();
    }

    public function hapus_transaksi($kode_transaksi)
    {
        DB::table('transaksi')->where('kode_transaksi', $kode_transaksi)->delete();
    }

    // pengiriman
    public function data_pengiriman($kode_transaksi)
    {
        return DB::table('pengiriman')->where('kode_transaksi', $kode_transaksi)->first();
    }

    public function hapus_pengiriman($kode_transaksi)
    {
        DB::table('pengiriman')->where('kode_transaksi', $kode_transaksi)->delete();
    }
    public function resi($kode_transaksi)
    {   
        $data = [
            "resi" => request()->input('resi'),
            "tanggal_kirim" => request()->input('tanggal_kirim')
        ];
        DB::table('pengiriman')->where('kode_transaksi', $kode_transaksi)->update($data);
    }

    public function tambah($keranjang)
    {
        foreach($keranjang as $keranjang) {
            $data = [
                'id_pelanggan'      => session('id_pelanggan'),
                'kode_transaksi'    => request()->input('kode_transaksi'),
                'id_produk'         => $keranjang->id,
                'harga'             => $keranjang->price,
                'jumlah'            => $keranjang->qty,
                'total_harga'       => $keranjang->subtotal,
                'tanggal_transaksi' => request()->input('tanggal_transaksi')
            ];

            DB::table('transaksi')->insert($data);
        }
    }
}
