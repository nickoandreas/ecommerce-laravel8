<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Rekening_model extends Model
{
    public function listing()
    {
        return DB::table('rekening')->get();
    }

    public function listingById($id_rekening)
    {
        return DB::table('rekening')->where('id_rekening', $id_rekening)->first();
    }

    public function tambah_rekening()
    {
        $data = [
            'nama_bank' => strtoupper(request()->input('nama_bank')),
            'nomor_rekening' => request()->input('nomor_rekening'),
            'nama_pemilik' => strtoupper(request()->input('nama_pemilik')) 
        ];

        DB::table('rekening')->insert($data);
    }

    public function update_rekening($id_rekening)
    {
        $data = [
            'nama_bank' => request()->input('nama_bank'),
            'nomor_rekening' => request()->input('nomor_rekening'),
            'nama_pemilik' => request()->input('nama_pemilik')
        ];

        DB::table('rekening')->where('id_rekening', $id_rekening)->update($data);
    }

    public function hapus_rekening($id_rekening)
    {
        DB::table('rekening')->where('id_rekening', $id_rekening)->delete();
    }
}
