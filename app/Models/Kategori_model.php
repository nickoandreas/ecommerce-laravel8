<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;

class Kategori_model extends Model
{
    public function listing()
    {
        return DB::table('kategori')->get();    
    }

    public function listingById($id_kategori)
    {
        return DB::table('kategori')->where('id_kategori', $id_kategori)->first();
    }

    public function listingBySlug($slug_kategori)
    {
        return DB::table('kategori')->where('slug_kategori', $slug_kategori)->first();
    }

    public function simpan_kategori()
    {   
        $data = [
            "nama_kategori" => strtoupper(request()->input('nama_kategori')),
            "slug_kategori" =>  Str::of(request()->input('nama_kategori'))->slug('-')
        ];

        DB::table('kategori')->insert($data);
    }

    public function update_kategori($id_kategori)
    {
        $data = [
            "nama_kategori" => strtoupper(request()->input('nama_kategori')),
            "slug_kategori" =>  Str::of(request()->input('nama_kategori'))->slug('-')
        ];

        DB::table('kategori')->where('id_kategori', $id_kategori)->update($data);
    }

    public function hapus_kategori($id_kategori)
    {
        DB::table('kategori')->where('id_kategori', $id_kategori)->delete();
    }


}
