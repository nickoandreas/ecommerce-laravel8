<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekening_model;

class Rekening extends Controller
{   
    
    public function __construct()
    {
       $this->Rekening_model = new Rekening_model();
       $this->middleware('preventBackHistory');
    }
    
    public function index()
    {
        $data['title'] = 'Data Rekening';
        $data['isi'] = 'admin.rekening.list';
        $data['rekening'] = $this->Rekening_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function tambah()
    {
        $data['title'] = "Tambah Rekening";
        $data['isi'] = 'admin.rekening.tambah';

        return view('admin.layout.wrapper', $data);
    }

    public function simpan()
    {
        request()->validate([
            'nama_bank' => 'required',
            'nomor_rekening' => 'required|unique:rekening,nomor_rekening',
            'nama_pemilik' => 'required'
        ]);

        $this->Rekening_model->tambah_rekening();
        request()->session()->flash('flash', 'Ditambahkan');
        return redirect('admin/rekening');
    }

    public function ubah($id_rekening)
    {
        $data['title'] = 'Edit Rekening';
        $data['isi'] = 'admin.rekening.ubah';
        $data['rekening'] = $this->Rekening_model->listingById($id_rekening);

        return view('admin.layout.wrapper', $data);
    }

    public function update($id_rekening)
    {
        request()->validate([
            'nama_bank' => 'required',
            'nomor_rekening' => 'required',
            'nama_pemilik' => 'required'
        ]);

        $this->Rekening_model->update_rekening($id_rekening);
        request()->session()->flash('flash', 'Diubah');
        return redirect('admin/rekening');
    }

    public function hapus($id_rekening)
    {
        $this->Rekening_model->hapus_rekening($id_rekening);
        request()->session()->flash('flash', 'Dihapus');
        return redirect('admin/rekening');
    }
}
