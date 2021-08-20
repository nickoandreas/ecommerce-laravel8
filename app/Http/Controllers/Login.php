<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Userapi_model;
use App\Models\Header_transaksi_model;

class Login extends Controller
{   
    
    public function __construct()
    {
        $this->middleware('preventBackHistory');
        $this->Userapi_model = new Userapi_model;
        $this->Header_transaksi_model = new Header_transaksi_model;
    }
    
    public function index()
    {   
        $data['title'] = 'Login Administrator';
        return view('login.list', $data);
    }

    public function login(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required|min:5'
        ]);

        $user = $this->Userapi_model->login($request->input('username'));
        if($user){
            $pasword = $user->password;
            $verifikasi = password_verify($request->input('password'), $pasword);
            if($verifikasi) {
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('nama', $user->nama);
                $request->session()->put('username', $user->username);
                $request->session()->put('akses_level', $user->akses_level);
               return redirect('/admin/dashboard');
            } else {
                return redirect('/admin/login')->with('warning', 'Password Atau Username Salah');
            }
        } else {
            return redirect('/admin/login')->with('warning', 'Password Atau Username Salah');
        }

    }

    public function keluar(Request $request)
    {
      $request->session()->forget('id_user');
      $request->session()->forget('nama');
      $request->session()->forget('username');
      $request->session()->forget('akses_level');
      return redirect('/admin/login')->with('sukses', 'Anda Berhasil Keluar');
    }
}
