<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk_model;

class Home extends Controller
{
    
    public function __construct()
    {
        $this->Produk_model = new Produk_model;
        $this->middleware('preventBackHistory');
    }
    
    public function index()
    {
        $data['title'] = 'Part Station';
        $data['isi'] = 'home.wrapper';
        $data['produk'] = $this->Produk_model->home();

        return view('layout.wrapper', $data);
    }
}
