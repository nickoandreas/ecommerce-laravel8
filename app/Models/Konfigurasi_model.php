<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Konfigurasi_model extends Model
{
   public function listing()
   {
       return DB::table('konfigurasi')->first();
   }

   public function ubah_home($id_konfigurasi)
   {   
       $data = [
            "namaweb" => request()->input('namaweb'),
            "tagline" => request()->input('tagline'),
            "email" => request()->input('email'),
            "website" => request()->input('website'),
            "keywords" => request()->input('keywords'),
            "metatext" => request()->input('metatext'),
            "telepon" => request()->input('telepon'),
            "alamat" => request()->input('alamat'),
            "facebook" => request()->input('facebook'),
            "instagram" => request()->input('instagram'),
            "deskripsi" => request()->input('deskripsi'),
            "rekening_pembayaran" => request()->input('rekening_pembayaran')
       ];
       DB::table('konfigurasi')->where('id_konfigurasi', $id_konfigurasi)->update($data);
   }

   public function ubah_icon($id_konfigurasi, $imageName)
   {
       $data = [
           "namaweb" => request()->input('namaweb'),
           "icon" => $imageName
       ];

       DB::table('konfigurasi')->where('id_konfigurasi', $id_konfigurasi)->update($data);

   }

   public function ubah_logo($id_konfigurasi, $imageName)
   {
       $data = [
           "namaweb" => request()->input('namaweb'),
           "logo" => $imageName
       ];

       DB::table('konfigurasi')->where('id_konfigurasi', $id_konfigurasi)->update($data);
   }
}
