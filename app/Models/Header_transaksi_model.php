<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Header_transaksi_model extends Model
{
    public function listing($status)    
    {
        $data = DB::table('header_transaksi')
                    ->leftJoin('pelanggan', 'pelanggan.id_pelanggan', '=', 'header_transaksi.id_pelanggan')
                    ->leftJoin('pengiriman', 'pengiriman.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->leftJoin('transaksi', 'transaksi.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->select('header_transaksi.*', 'pelanggan.nama_pelanggan', 'pengiriman.*')
                    ->selectRaw('SUM(transaksi.jumlah) AS total_item')
                    ->where('header_transaksi.status_bayar', $status)
                    ->groupBy('id_header_transaksi')
                    ->get();

        return $data;
    }

    public function listingByKode($kode_transaksi)
    {
        return DB::table('header_transaksi')
                    ->leftJoin('pengiriman', 'pengiriman.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->select('header_transaksi.*', 'pengiriman.*')
                    ->where('header_transaksi.kode_transaksi', $kode_transaksi)
                    ->first();
    }

    public function konfirmasi_awal()
    {
        return DB::table('header_transaksi')
                    ->join('transaksi', 'transaksi.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->join('pengiriman', 'pengiriman.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->groupBy('header_transaksi.id_header_transaksi')
                    ->select('header_transaksi.*', 'pengiriman.ongkir')
                    ->selectRaw('SUM(transaksi.jumlah) AS total_item')
                    ->where('nama_pelanggan', session('nama_pelanggan'))
                    ->where('status_bayar', 'Menunggu Pembayaran')
                    ->orderBy('tanggal_post', 'DESC')
                    ->get();
    }

    public function hapus_transaksi($kode_transaksi)
    {
        DB::table('header_transaksi')->where('kode_transaksi', $kode_transaksi)->delete();
    }

    public function update_status($kode_transaksi, $status)
    {
        DB::table('header_transaksi')->where('kode_transaksi', $kode_transaksi)->update(['status_bayar' => $status]);
    }

    public function tambah()
    {
        $data = [
            'id_pelanggan'      => session('id_pelanggan'),
            'nama_pelanggan'    => session('nama_pelanggan'),
            'email'             => session('email'),
            'telepon'           => request()->input('telepon'),
            'kode_transaksi'    => request()->input('kode_transaksi'),
            'tanggal_transaksi' => request()->input('tanggal_transaksi'),
            'jumlah_transaksi'  => request()->input('jumlah_transaksi'),
            'status_bayar'      => 'Menunggu Pembayaran',
            'tanggal_post'      => date('Y-m-d H:i:s')
        ];

        DB::table('header_transaksi')->insert($data);
    }

    public function transaksi()    
    {
        return DB::table('header_transaksi')
                    ->leftJoin('pengiriman', 'pengiriman.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->leftJoin('transaksi', 'transaksi.kode_transaksi', '=', 'header_transaksi.kode_transaksi')
                    ->groupBy('kode_transaksi')
                    ->select('header_transaksi.*', 'pengiriman.ongkir')
                    ->selectRaw('SUM(transaksi.jumlah) AS total_item')
                    ->where('nama_pelanggan', session('nama_pelanggan'))
                    ->orderBy('tanggal_post', 'DESC')
                    ->paginate(5);
    }

    public function update_buktibayar($imageName, $kode_transaksi)
    {
        $data = [
            'status_bayar'          => 'Menunggu Konfirmasi Admin',
            'jumlah_bayar'          => request()->input('jumlah_bayar'),
            'rekening_pembayaran'   => request()->input('rekening_pembayaran'),
            'rekening_pelanggan'    => request()->input('rekening_pelanggan'),
            'bukti_bayar'           => $imageName,
            'id_rekening'           => request()->input('id_rekening'),
            'tanggal_bayar'         => request()->input('tanggal_bayar'),
            'nama_bank'             => request()->input('nama_bank')
        ];

        DB::table('header_transaksi')->where('kode_transaksi', $kode_transaksi)->update($data);
    }
}
