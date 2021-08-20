<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori_model;

class Kategori extends Controller
{
    
    public function __construct()
    {
        $this->Kategori_model = new Kategori_model();
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        $data['title'] = 'Kategori Produk';
        $data['isi'] = 'admin.kategori.list';
        $data['kategori'] = $this->Kategori_model->listing();
       
        return view('admin.layout.wrapper', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Kategori';
        $data['isi'] = 'admin.kategori.tambah';

        return view('admin.layout.wrapper', $data);
    }

    public function simpan()
    {
        request()->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori'
        ]);

        $this->Kategori_model->simpan_kategori();
        return redirect('admin/kategori')->with('flash', 'Ditambah');
    }

    public function ubah($id_kategori)
    {
        $data['title'] = 'Edit Kategori Produk';
        $data['isi'] = 'admin.kategori.ubah';
        $data['kategori'] = $this->Kategori_model->listingById($id_kategori);

        return view('admin.layout.wrapper', $data);
    }

    public function update($id_kategori)
    {
        request()->validate([
            'nama_kategori' => 'required'
        ]);

        $this->Kategori_model->update_kategori($id_kategori);
        return redirect('admin/kategori')->with('flash', "Diubah");
    }

    public function hapus($id_kategori)
    {
        $this->Kategori_model->hapus_kategori($id_kategori);
        return redirect('admin/kategori')->with('flash', 'Dihapus');
    }
    
}
