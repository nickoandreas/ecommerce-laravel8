<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konfigurasi_model;
use Image;

class Konfigurasi extends Controller
{
    
    public function __construct()
    {
        $this->Konfigurasi_model = new Konfigurasi_model();
        $this->middleware('preventBackHistory');
    }

    public function home()
    {
        $data['title'] = 'Konfigurasi Website';  
        $data['isi'] = 'admin.konfigurasi.list';
        $data['konfigurasi'] = $this->Konfigurasi_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function update($id_konfigurasi)
    {
        request()->validate([
            'namaweb' => 'required'
        ]);

        $this->Konfigurasi_model->ubah_home($id_konfigurasi);
        request()->session()->flash('flash', 'Diubah');
        return redirect('/admin/konfigurasi');
    }

    public function icon()
    {
        $data['title'] = 'Setting Icon';
        $data['isi'] = 'admin.konfigurasi.icon';
        $data['konfigurasi'] = $this->Konfigurasi_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function update_icon($id_konfigurasi)
    {
        request()->validate([
            'namaweb' => 'required',
            'icon' => 'required|image|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=6000,max_height=6000'        
        ]);

        $path_upload = public_path('assets/upload/image/');
        $path_thumbs = public_path('assets/upload/image/thumbs/');
        $konfigurasi = $this->Konfigurasi_model->listing();
        unlink($path_upload . $konfigurasi->icon);
        unlink($path_thumbs . $konfigurasi->icon);

        $image = request()->file('icon');
        $imageName = $image->getClientOriginalName();
        $img = Image::make($image->path());
        $img->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        })->save($path_thumbs. '/' . $imageName);

        $image->move($path_upload, $imageName);

        $this->Konfigurasi_model->ubah_icon($id_konfigurasi, $imageName);
        request()->session()->flash('flash', 'Diubah');
        return redirect('/admin/konfigurasi/icon');
    }

    public function logo()
    {
        $data['title'] = 'Setting Logo';
        $data['isi'] = 'admin.konfigurasi.logo';
        $data['konfigurasi'] = $this->Konfigurasi_model->listing();

        return view('admin.layout.wrapper', $data);
    }

    public function update_logo($id_konfigurasi)
    {
        request()->validate([
            'namaweb' => 'required',
            'logo' => 'required|image|mimes:jpeg,jpg,png|max:5000|dimensions:max_width=6000,max_height=6000'
        ]);

        $path_upload = public_path('assets/upload/image/');
        $path_thumbs = public_path('assets/upload/image/thumbs/');
        $konfigurasi = $this->Konfigurasi_model->listing();
        unlink($path_upload . $konfigurasi->logo);
        unlink($path_thumbs . $konfigurasi->logo);

        $image = request()->file('logo');
        $imageName = $image->getClientOriginalName();
        $img = Image::make($image->path());
        $img->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        })->save($path_thumbs. '/' . $imageName);

        $image->move($path_upload, $imageName);

        $this->Konfigurasi_model->ubah_logo($id_konfigurasi, $imageName);
        request()->session()->flash('flash', 'Diubah');
        return redirect('/admin/konfigurasi/logo');
    }

    
}
