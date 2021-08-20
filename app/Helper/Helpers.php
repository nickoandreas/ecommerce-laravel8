<?php 
namespace App\Helper;

class Helpers {


   public static function cek_login()
   {  
      session_start();
      if(session('email') == NULL ){
         $_SESSION['warning'] = "Anda Belum Login";
         header("location: /login", true, 301);
         exit();
      }
   }

   public static function belum_masuk()
   {
      if(session('email') == NULL){
         header('location: /', true, 301);
         exit();
      }
   }

   public static function sudah_masuk()
   {
      if(session('email') && session('nama_pelanggan') != NULL){
         header('location: /', true, 301);
         exit();
      }
   }

   public static function sudah_checkout()
   {
      if(session('kode_transaksi') == NULL){
         header('location: /', true, 301);
         exit();
      }
   }

}