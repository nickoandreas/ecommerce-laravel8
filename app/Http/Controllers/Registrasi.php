<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan_model;
use App\Models\Rajaongkir_model;
use SimpleLogin;

class Registrasi extends Controller
{   
    
    public function __construct()
    {
        $this->Pelanggan_model = new Pelanggan_model;
        $this->Rajaongkir_model = new Rajaongkir_model;
    }
    
    public function index()
    {
        $data['title'] = 'Registrasi Pelanggan';
        $data['isi'] = 'registrasi.list';
        $data['provinsi'] = $this->Rajaongkir_model->provinsi();
        
        SimpleLogin::sudah_masuk();
        return view('layout.wrapper', $data);
    }

    public function registrasi()
    {
        request()->validate([
            "nama_pelanggan" => "required",
            "email" => "required|email|unique:pelanggan,email",
            "password" => "required|min:5",
            "telepon" => "required"
        ]);

        $this->Pelanggan_model->tambah();
        session(["email" => request()->input('email')]);
        return redirect('/registrasi/sukses')->with('sukses_registrasi', 'Selamat Datang, Terimakasih Sudah Registrasi');
    }

    public function sukses()
    {
        $data['title'] = 'Registrasi Berhasil';
        $data['isi'] = 'registrasi.sukses';

        SimpleLogin::belum_masuk();
        SimpleLogin::sudah_masuk();
        return view('layout.wrapper', $data);
    }
}
