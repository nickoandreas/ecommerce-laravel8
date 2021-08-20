<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Dashboard_model extends Model
{
    public function total_produk()
    {
        return DB::table('produk')->selectRaw('COUNT(*) AS total_produk')->first();
    }

    public function total_pelanggan()
    {
        return DB::table('pelanggan')->selectRaw('COUNT(*) AS total_pelanggan')->first();
    }

    public function total_transaksi()
    {
        return DB::table('header_transaksi')
                    ->where('status_bayar', 'Pesanan Sudah Diterima')
                    ->selectRaw('COUNT(*) AS total_transaksi')
                    ->first();
    }

    public function omset()
    {
        return  DB::table('header_transaksi')
                    ->where('status_bayar', 'Pesanan Sudah Diterima')
                    ->sum('jumlah_transaksi');
               
    }
}
