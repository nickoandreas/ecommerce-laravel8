<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk_model;
use App\Models\Kategori_model;
use Image;

class Produk extends Controller
{   
    
    public function __construct()
    {
       $this->Produk_model = new Produk_model;
       $this->Kategori_model = new Kategori_model;
       $this->middleware('preventBackHistory');
    }
    
    public function index()
    {
        $data['title'] = 'Data Produk';
        $data['isi'] = 'admin.produk.list';
        $data['produk'] = $this->Produk_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Produk';
        $data['isi'] = 'admin.produk.tambah';
        $data['kategori'] = $this->Kategori_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function simpan()
    {
        request()->validate([
            'nama_produk' => 'required',
            'kode_produk' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=6000,max_height=6000'
        ]);

        $path_upload = public_path('assets/upload/image/');
        $path_thumbs = public_path('assets/upload/image/thumbs/');

        $image = request()->file('gambar');
        $imageName = $image->getClientOriginalName();
        $img = Image::make($image->path());
        $img->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        })->save($path_thumbs. '/' . $imageName);

        $image->move($path_upload, $imageName);

        $this->Produk_model->simpan_produk($imageName);
        return redirect('/admin/produk')->with('flash', 'Ditambah');
    }

    public function ubah($id_produk)
    {
        $data['title'] = "Update Produk";
        $data['isi'] = 'admin.produk.ubah';
        $data['produk'] = $this->Produk_model->listingById($id_produk);
        $data['kategori'] = $this->Kategori_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function update($id_produk)
    {
        request()->validate([
            'nama_produk' => 'required',
            'kode_produk' => 'required',
            'gambar' => 'image|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=6000,max_height=6000'
        ]);

        if(request()->file('gambar') != NULL) {
            $path_upload = public_path('assets/upload/image/');
            $path_thumbs = public_path('assets/upload/image/thumbs/');
            $produk = $this->Produk_model->listingById($id_produk);
            unlink($path_thumbs.$produk->gambar);
            unlink($path_upload.$produk->gambar);

            $image = request()->file('gambar');
            $imageName = $image->getClientOriginalName();
            $img = Image::make($image->path());
            $img->resize(250, 250, function($constraint) {
                $constraint->aspectRatio();
            })->save($path_thumbs. '/' . $imageName);

            $image->move($path_upload, $imageName);
            $this->Produk_model->ubah_produk($id_produk, $imageName);
            return redirect('/admin/produk')->with('flash', 'Diubah');

        } else {
            $this->Produk_model->ubah_produk($id_produk);
            return redirect('/admin/produk')->with('flash', 'Diubah');
        }
    }

    public function gambar($id_produk)
    {
        $produk = $this->Produk_model->listingById($id_produk);
        $gambarProduk = $this->Produk_model->gambarDetail($id_produk);
        $data['title'] = 'Tambah Gambar Produk';
        $data['isi'] = 'admin.produk.gambar';
        $data['produk'] = $produk;
        $data['dataGambar'] = $gambarProduk;

        return view('admin.layout.wrapper', $data);
    }

    public function simpan_gambar()
    {
        request()->validate([
            "judul_gambar" => "required",
            "gambar" => "required|image|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=6000,max_height=6000"
        ]);

        $path_upload = public_path('assets/upload/image/');
        $path_thumbs = public_path('assets/upload/image/thumbs/');

        $image = request()->file('gambar');
        $imageName = $image->getClientOriginalName();
        $img = Image::make($image->path());
        $img->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        })->save($path_thumbs. '/' . $imageName);

        $image->move($path_upload, $imageName);

        $this->Produk_model->tambah_gambar($imageName);
        return redirect('/admin/produk/gambar/'.request()->input('id_produk'))->with('flash', 'Ditambah');
    }

    public function hapus($id_produk)
    {
        $produk = $this->Produk_model->listingById($id_produk);
        unlink(public_path('assets/upload/image/').$produk->gambar);
        unlink(public_path('assets/upload/image/thumbs/').$produk->gambar);
        $this->Produk_model->hapus_produk($id_produk);
        return redirect('/admin/produk')->with('flash', 'Dihapus');
    }

    public function hapus_gambar($id_gambar)
    {
        $gambar = $this->Produk_model->gambarById($id_gambar);
        unlink(public_path('assets/upload/image/thumbs/').$gambar->gambar);
        unlink(public_path('assets/upload/image/').$gambar->gambar);
        $this->Produk_model->hapus_gambar($id_gambar);
        return redirect('/admin/produk/gambar/'.$gambar->id_produk)->with('flash', 'Dihapus');
    }
}
