<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Collection;

class Userapi_model extends Model
{
    public function listing()
   {
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/RestServer/user",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
         "key: 8cb2237d0679ca88db6464eac60da96345513964"
      ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      
      if ($err) {
      echo "cURL Error #:" . $err;
      } 
      else {
         $response = json_decode($response);
         return $response->data;
      }
   }

   public function listingById($id)
   {
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/RestServer/user?id_user=".$id,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
         "key: 8cb2237d0679ca88db6464eac60da96345513964"
      ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      
      if ($err) {
      echo "cURL Error #:" . $err;
      } 
      else {
         $response = json_decode($response);
         return $response->data;
      }
   }

   public function login($username)
   {
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/RestServer/user?username=".$username,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
         "key: 8cb2237d0679ca88db6464eac60da96345513964"
      ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      
      if ($err) {
      echo "cURL Error #:" . $err;
      } 
      else {
         $response = json_decode($response);
         return $response->data;
      }
   }

   public function tambah()
   {  
      
      $nama = request()->input('nama');
      $email = request()->input('email');
      $username = request()->input('username');
      $password = password_hash(request()->input('password'), PASSWORD_BCRYPT);
      $akses_level = request()->input('akses_level');

      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/RestServer/user",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "nama=".$nama."&email=".$email."&username=".$username."&password=".$password."&akses_level=".$akses_level,
      CURLOPT_HTTPHEADER => array(
         "content-type: application/x-www-form-urlencoded",
         "key: 8cb2237d0679ca88db6464eac60da96345513964"
      ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
      echo "cURL Error #:" . $err;
      } else {
         return $response = json_decode($response);
      }


   }

   public function hapus($id)
   {
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/RestServer/user",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "DELETE",
      CURLOPT_POSTFIELDS => "id_user=".$id,
      CURLOPT_HTTPHEADER => array(
         "content-type: application/x-www-form-urlencoded",
         "key: 8cb2237d0679ca88db6464eac60da96345513964"
      ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
      echo "cURL Error #:" . $err;
      } else {
         return $response = json_decode($response);
      }
   }

   public function ubah($id)
   {  
      $nama = request()->input('nama');
      $email = request()->input('email');
      $akses_level = request()->input('akses_level');

      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://localhost/RestServer/user",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_POSTFIELDS => "id_user=".$id."&nama=".$nama."&email=".$email."&akses_level=".$akses_level,
      CURLOPT_HTTPHEADER => array(
         "content-type: application/x-www-form-urlencoded",
         "key: 8cb2237d0679ca88db6464eac60da96345513964"
      ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
      echo "cURL Error #:" . $err;
      } else {
         return $response = json_decode($response);
      }
   }
}
