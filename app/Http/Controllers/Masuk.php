<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan_model;
use SimpleLogin;

class Masuk extends Controller
{
    
    public function __construct()
    {
        $this->Pelanggan_model = new Pelanggan_model;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {   
        $data['title'] = 'Login Pelanggan';
        $data['isi'] = 'masuk.list';

        SimpleLogin::sudah_masuk();
        return view('layout.wrapper', $data);
    }

    public function login()
    {
        request()->validate([
            "email" => "required|email",
            "password" => "required|min:5"
        ]);

        $pelanggan = $this->Pelanggan_model->listingByEmail(request()->input('email'));
        if($pelanggan) {
            $password = $pelanggan->password;
            $verifikasi = password_verify(request()->input('password'), $password);
            if($verifikasi) {
                request()->session()->put('id_pelanggan', $pelanggan->id_pelanggan);
                request()->session()->put('email', $pelanggan->email);
                request()->session()->put('nama_pelanggan', $pelanggan->nama_pelanggan);
                return redirect('/');
            } else {
                return redirect('/login')->with('warning', 'Password Atau Username Salah');
            }
        } else {
            return redirect('/login')->with('warning', 'Password Atau Username Salah');
        }
    }

    public function logout()
    {
        request()->session()->forget('id_pelanggan');
        request()->session()->forget('email');
        request()->session()->forget('nama_pelanggan');
        return redirect('/');
    }
    
}
