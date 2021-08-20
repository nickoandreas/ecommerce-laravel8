<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_model extends Model
{
    public function listing()
    {
        return DB::table('users')->get();
    }

    public function listingById($id_user)
    {
       return DB::table('users')->where('id_user', $id_user)->first();
    }
    
    public function tambah_user()
    {
        $data = [
            'nama' => request()->input('nama'),
            'email' => request()->input('email'),
            'username' => request()->input('username'),
            'password' => bcrypt(request()->input('password')),
            'akses_level' => request()->input('akses_level'),
        ];
        
        DB::table('users')->insert($data);

    }

    public function update_user($id_user)
    {
        $data = [
            'nama' => request()->input('nama'),
            'email' => request()->input('email'),
            'akses_level' => request()->input('akses_level')
        ];

        DB::table('users')->where('id_user', $id_user)->update($data);
    }

    public function hapus_user($id_user)
    {
        DB::table('users')->where('id_user', $id_user)->delete();
    }

    public function login($username)
    {
        return DB::table('users')->where(['username' => $username])->first();
    }
}
