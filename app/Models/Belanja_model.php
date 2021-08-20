<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Belanja_model extends Model
{   
    public function listingByRowid($rowid)
    {
        return DB::table('keranjang')->where('rowid', $rowid)->first();
    }

    public function insert()
    {
        $id_produk = request()->input('id');
        $produk_cart = DB::table('keranjang')->where('id', $id_produk)->where('id_pelanggan', session('id_pelanggan'))->first();
        if($produk_cart) {
            $data = [
                "qty" => $produk_cart->qty + request()->input('qty'),
                "subtotal" => $produk_cart->subtotal + (request()->input('price')*request()->input('qty'))
            ];

            $kondisi = [['id', $id_produk], ['id_pelanggan', session('id_pelanggan')]];
            DB::table('keranjang')->where($kondisi)->update($data);

        } else {
            $data = [
                "id" => $id_produk,
                "id_pelanggan" => session('id_pelanggan'),
                "name" => request()->input('name'),
                "price" => request()->input('price'),
                "qty" => request()->input('qty'),
                "subtotal" => request()->input('price') * request()->input('qty')
            ];

            DB::table('keranjang')->insert($data);
        }
    }

    public function contents()
    {
       $id_pelanggan = session('id_pelanggan');
       return DB::table('keranjang')->where('id_pelanggan', $id_pelanggan)->get();
    }

    public function total()
    {
        $id_pelanggan = session('id_pelanggan');
        return DB::table('keranjang')
                    ->where('id_pelanggan', $id_pelanggan)
                    ->sum('subtotal');
    }

    public function update_cart($rowid)
    {
        $data = [
            "qty" => request()->input("qty"),
            "subtotal" => request()->input('price') * request()->input("qty")
        ];

        DB::table('keranjang')->where('rowid', $rowid)->update($data);
    }

    public function hapus($rowid) 
    {
        DB::table('keranjang')->where('rowid', $rowid)->delete();
    }

    public function hapus_semua()
    {
        DB::table('keranjang')->where('id_pelanggan', session('id_pelanggan'))->delete();
    }
}
