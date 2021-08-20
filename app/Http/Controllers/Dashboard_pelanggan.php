<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Header_transaksi_model;
use App\Models\Transaksi_model;
use App\Models\Pelanggan_model;
use App\Models\Rajaongkir_model;
use App\Models\Rekening_model;
use Image;
use SimpleLogin;

class Dashboard_pelanggan extends Controller
{   
    
    public function __construct()
    {
        $this->Header_transaksi_model = new Header_transaksi_model;
        $this->Transaksi_model = new Transaksi_model;
        $this->Rajaongkir_model = new Rajaongkir_model;
        $this->Pelanggan_model = new Pelanggan_model;
        $this->Rekening_model = new Rekening_model;
        $this->middleware('preventBackHistory');
    }
    
    public function index()
    {   
        SimpleLogin::cek_login();
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['isi']   = 'dashboard.list';
        $data['header_transaksi'] = $this->Header_transaksi_model->konfirmasi_awal();
        $data['rekening'] = $this->Rekening_model->listing();

        return view('layout.wrapper', $data);
    }

    public function konfirmasi($kode_transaksi)
    {   
        SimpleLogin::cek_login();
        $header_transaksi = $this->Header_transaksi_model->listingByKode($kode_transaksi);

        if($header_transaksi->id_pelanggan != session('id_pelanggan')) {
            return redirect('/');
        }

        request()->validate([
            'bukti_bayar' => 'image|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=6000,max_height=6000'
        ]);

        $path_upload = public_path('assets/upload/image/bukti_pembayaran/');
        $path_thumbs = public_path('assets/upload/image/thumbs/bukti_pembayaran/');
       
        $image = request()->file('bukti_bayar');
        $imageName = $image->getClientOriginalName();
        $img = Image::make($image->path());
        $img->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        })->save($path_thumbs. '/' . $imageName);

        $image->move($path_upload, $imageName);

        $this->Header_transaksi_model->update_buktibayar($imageName, $kode_transaksi);
        return redirect('/dashboard')->with('flash', 'Konfirmasi Pembayaran Berhasil');

    }

    public function belanja()
    {   
        SimpleLogin::cek_login();
        $data['title'] = 'PesananKu';
        $data['isi'] = 'dashboard/belanja';
        $data['header_transaksi'] = $this->Header_transaksi_model->transaksi();

        return view('layout.wrapper', $data);
    }

    public function detail($kode_transaksi)
    {   
        SimpleLogin::cek_login();
        $header_transaksi = $this->Header_transaksi_model->listingByKode($kode_transaksi);
        $transaksi = $this->Transaksi_model->listingByKode($kode_transaksi);
        if($header_transaksi->id_pelanggan != session('id_pelanggan')) {
            return redirect('/');
        }   
        $data['title'] = 'Detail PesananKu';
        $data['isi'] = 'dashboard.detail';
        $data['header_transaksi'] = $header_transaksi;
        $data['transaksi'] = $transaksi;

        return view('layout.wrapper', $data);
    }

    public function profile()
    {   
        SimpleLogin::cek_login();
        $data['title'] = 'Profile';
        $data['isi'] = 'dashboard.profile';
        $data['pelanggan'] = $this->Pelanggan_model->listingByEmail(session('email'));
        $data['provinsi'] = $this->Rajaongkir_model->provinsi();

        return view('layout.wrapper', $data);
    }

    public function update_profile()
    {   
        SimpleLogin::cek_login();
        request()->validate([
            'nama_pelanggan'        => 'required',
            'id_provinsi'           => 'required',
            'id_kota'               => 'required',
            'alamat'                => 'required',
            'telepon'               => 'required'
        ]);

        $this->Pelanggan_model->edit();
        return redirect('/dashboard/profile')->with('sukses_update', 'Data Berhasil di Ubah');
    }

    public function batalkan($kode_transaksi)
    {   
        SimpleLogin::cek_login();
        $this->Transaksi_model->hapus_transaksi($kode_transaksi);
        $this->Header_transaksi_model->hapus_transaksi($kode_transaksi);
        $this->Transaksi_model->hapus_pengiriman($kode_transaksi);

        return redirect('/dashboard');
    }
}
