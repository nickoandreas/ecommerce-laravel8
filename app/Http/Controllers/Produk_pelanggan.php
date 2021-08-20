<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk_model;
use App\Models\Kategori_model;

class Produk_pelanggan extends Controller
{
    
    public function __construct()
    {
        $this->Produk_model = new Produk_model;
        $this->Kategori_model = new Kategori_model;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        $data['title'] = 'Semua Produk';
        $data['isi'] = 'produk.list';
        $data['produk'] = $this->Produk_model->semua_produk();
       
        return view('layout.wrapper', $data);
    }

    public function parts_motor()
    {
        $data['title'] = 'Parts Motor';
        $data['isi'] = 'produk.list';
        $data['produk'] = $this->Produk_model->sub_produk('R2');

        return view('layout.wrapper', $data);
    }

    public function parts_mobil()
    {
        $data['title'] = 'Parts Mobil';
        $data['isi'] = 'produk.list';
        $data['produk'] = $this->Produk_model->sub_produk('R4');

        return view('layout.wrapper', $data);
    }

    public function kategori2($slug_kategori)
    {   
        $kategori = $this->Kategori_model->listingBySlug($slug_kategori);
        $data['title'] = 'Parts Motor';
        $data['isi'] = 'produk.list';
        $data['kategori'] = $kategori->nama_kategori;
        $data['produk'] = $this->Produk_model->kategori($kategori->id_kategori);

        return view('layout.wrapper', $data);
    }

    public function kategori4($slug_kategori)
    {
        $kategori = $this->Kategori_model->listingBySlug($slug_kategori);
        $data['title'] = 'Parts Mobil';
        $data['isi'] = 'produk.list';
        $data['kategori'] = $kategori->nama_kategori;
        $data['produk'] = $this->Produk_model->kategori($kategori->id_kategori);

        return view('layout.wrapper', $data);
    }

    public function detail($slug_produk)
    {
        $produk = $this->Produk_model->listingBySlug($slug_produk);
        $id_produk = $produk->id_produk;

        $data['title'] = $produk->nama_produk;
        $data['produk'] = $produk;
        $data['isi'] = 'produk.detail';
        $data['produk_promo'] = $this->Produk_model->home();
        $data['gambar'] = $this->Produk_model->gambarDetail($id_produk);

        return view('layout.wrapper', $data);
    }

    // autocomplete
    public function get_produk($keyword)
    {   
        if($keyword == 'tidak ada') {
            echo '<p class="d-none"></p>';
            die;
        }
        $produk = $this->Produk_model->cari_produk($keyword);
        if(count($produk) > 0) {
            foreach($produk as $produk) {
            echo '<a href="/produk/detail/'.$produk->slug_produk.'"><li class="list-group-item hov1" style="height: 65px;" ><div class="d-inline float-left"><img src="'.asset('assets/upload/image/thumbs/'.$produk->gambar.'').'" class="img-thumbnail" width="40" height="40"></div><div class="ml-5 text-justify overflow-hidden mt-2 s-text7" style="height: 20px;"> '.$produk->nama_produk.'</div></li></a>';
            }
         } else {
            echo "<li class='list-group-item s-text7'> PRODUK TIDAK TERSEDIA... </li>";
         }
    }
    
}
