<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Belanja_model;
use App\Models\Pelanggan_model;
use App\Models\Header_transaksi_model;
use App\Models\Transaksi_model;
use App\Models\Rajaongkir_model;
use App\Models\Rekening_model;
use SimpleLogin;

class Belanja extends Controller
{   
    
    public function __construct()
    {   
        $this->Belanja_model = new Belanja_model;
        $this->Pelanggan_model = new Pelanggan_model;
        $this->Header_transaksi_model = new Header_transaksi_model;
        $this->Transaksi_model = new Transaksi_model;
        $this->Rajaongkir_model = new Rajaongkir_model;
        $this->Rekening_model = new Rekening_model;
        $this->middleware('preventBackHistory');
    }
    
    public function index()
    {   
        SimpleLogin::cek_login();
        $data['title'] = 'Keranjang Belanja';
        $data['keranjang'] = $this->Belanja_model->contents();
        $data['total_belanja'] = $this->Belanja_model->total();
        $data['isi'] = 'belanja.list';

        return view('layout.wrapper', $data);
    }

    public function add()
    {   
        SimpleLogin::cek_login();
        $redirect_page = request()->input('redirect_page');
        $this->Belanja_model->insert();
        request()->session()->flash('flash-cart2', 'Masuk Keranjang Belanja');
        return redirect($redirect_page);
    }

    public function update($rowid)
    {   
        SimpleLogin::cek_login();
        $this->Belanja_model->update_cart($rowid);
        return redirect('/belanja')->with('sukses', 'Data Keranjang Telah di Update');
    }

    public function hapus($rowid)
    {   
        SimpleLogin::cek_login();
        $produk_cart = $this->Belanja_model->listingByRowid($rowid);
        if(!empty($produk_cart) && $produk_cart->id_pelanggan == session('id_pelanggan')) {
            $this->Belanja_model->hapus($rowid);
            return redirect('/belanja')->with('sukses', 'Data Keranjang Belanja Telah Dihapus');

        } else {
            return redirect('/belanja')->with('sukses', 'Item Tidak Ada di Keranjang Anda');
        }
    }

    public function hapus_semua()
    {   
        SimpleLogin::cek_login();
        $this->Belanja_model->hapus_semua();
        return redirect('/belanja')->with('sukses', 'Semua Data Keranjang Telah Dihapus');
    }

    public function hal_checkout()
    {   
        SimpleLogin::cek_login();
        $data['title'] = 'Checkout';
        $data['isi'] = 'belanja.checkout';
        $data['keranjang'] = $this->Belanja_model->contents();
        $data['pelanggan'] = $this->Pelanggan_model->listingByEmail(session('email'));
        
        return view('layout.wrapper', $data);

    }

    public function checkout()
    {   
        SimpleLogin::cek_login();
        request()->validate([
            "expedisi" => "required",
            "layanan" => "required"
        ]);
        $keranjang = $this->Belanja_model->contents();
        $this->Header_transaksi_model->tambah();
        $this->Transaksi_model->tambah($keranjang);
        $this->Rajaongkir_model->tambah_pengiriman();
        session(['kode_transaksi' => request()->input('kode_transaksi')]);
        $this->Belanja_model->hapus_semua();
        return redirect('/belanja/sukses')->with('sukses_checkout', 'Checkout Berhasil');
    }

    public function sukses()
    {   
        SimpleLogin::cek_login();
        SimpleLogin::belum_masuk();
        $data['title'] = 'Checkout Berhasil';
        $data['rekening'] = $this->Rekening_model->listing();
        $data['isi'] = 'belanja.sukses';
        SimpleLogin::sudah_checkout();
        request()->session()->forget('kode_transaksi');
        return view('layout.wrapper', $data);
    }
}
