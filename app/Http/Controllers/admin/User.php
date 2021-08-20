<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Userapi_model;
  

class User extends Controller
{   
    
    public function __construct()
    {
        $this->Userapi_model = new Userapi_model();
        $this->middleware('preventBackHistory');
    }
    
    public function index()
    {
        $waktu_mulai    = microtime(true);
        $user           = $this->Userapi_model->listing();
        $waktu_selesai  = microtime(true);
        $waktu_eksekusi = $waktu_selesai - $waktu_mulai;
        

        $data['title'] = 'Data Pengguna';
        $data['user']  = $user;
        $data['isi'] = 'admin.user.list';
        $data['waktu_eksekusi'] = number_format($waktu_eksekusi, 3);
        $data['jumlah_user']  = count($user);

        return view('admin.layout.wrapper', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pengguna'; 
        $data['isi'] = 'admin.user.tambah';

        return view('admin.layout.wrapper', $data);
    }

    public function simpan()
    {   
        request()->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email|email',
            'username' => 'required|unique:users,username|max:10|min:5',
            'password' => 'required|min:5'
        ]);

        request()->session()->flash('user', request()->input('nama'));
        request()->session()->flash('time_awal', microtime(true));
        $this->Userapi_model->tambah();
        request()->session()->flash('time_akhir', microtime(true));

        request()->session()->flash('flash', 'Ditambah');
        return redirect('/admin/user')->with('msg', 'Waktu Untuk Menambahkan Data '.session('user').' (CREATE)');
    }

    public function ubah($id_user)
    {
        $data['title'] = 'Edit Pengguna';
        $data['isi'] = 'admin.user.ubah';
        $data['user'] = $this->Userapi_model->listingById($id_user);
        $data['level'] = ['Admin', 'User'];

        return view('admin.layout.wrapper', $data);
    }

    public function update($id_user)
    {   
        request()->validate([
            'nama' => 'required',
            'email' => 'required|email',
        ]);

        request()->session()->flash('user', request()->input('nama'));
        request()->session()->flash('time_awal', microtime(true));
        $this->Userapi_model->ubah($id_user);
        request()->session()->flash('time_akhir', microtime(true));

        request()->session()->flash('flash', 'Diubah');
        return redirect('/admin/user')->with('msg', 'Waktu Untuk Mengubah Data '.session('user').' (UPDATE)');
        
    }
    

    public function hapus($id_user)
    {
        $user = $this->Userapi_model->listingById($id_user);
        request()->session()->flash('user', $user->nama);
        request()->session()->flash('time_awal', microtime(true));
        $this->Userapi_model->hapus($id_user);
        request()->session()->flash('time_akhir', microtime(true));
        request()->session()->flash('flash', 'Dihapus');
        return redirect('/admin/user')->with('msg', 'Waktu Untuk Menghapus Data '.session('user').' (DELETE)');
    }


}
