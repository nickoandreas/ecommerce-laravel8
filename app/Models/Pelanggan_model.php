<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pelanggan_model extends Model
{
    public function listingByEmail($email)
    {
       return DB::table('pelanggan')->where('email', $email)->first();
    }

    public function tambah()
    {   
        $data = [
            "nama_pelanggan"    => request()->input("nama_pelanggan"),
            "email"             => request()->input("email"),
            "password"          => bcrypt(request()->input('password')),
            "telepon"           => request()->input('telepon'),
            "id_provinsi"       => request()->input('id_provinsi'),
            "id_kota"           => request()->input('id_kota'),
            "alamat"            => request()->input('alamat'),
            "tanggal_daftar"    => date('Y-m-d H:i:s')
        ];
        DB::table('pelanggan')->insert($data);
    }

    public function edit()
    {
        $data = [
            'nama_pelanggan'    => request()->input('nama_pelanggan'),
            'telepon'           => request()->input('telepon'),
            'id_provinsi'       => request()->input('id_provinsi'),
            'id_kota'           => request()->input('id_kota'),
            'alamat'            => request()->input('alamat')
        ];

        return DB::table('pelanggan')->where('id_pelanggan', session('id_pelanggan'))->update($data);
    }
}
