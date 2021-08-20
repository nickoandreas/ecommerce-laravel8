<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_transaksi_model;
use App\Models\Dashboard_model;


class Dashboard extends Controller
{   
    
    public function __construct()
    {
       $this->Header_transaksi_model = new Header_transaksi_model();
       $this->Dashboard_model = new Dashboard_model();
       $this->middleware('preventBackHistory');
 
    }
    
    public function index()
    {   
        $data['title'] = 'Halaman Administrator';
        $data['isi'] = 'admin.dashboard.list';
        $data['header_transaksi'] = $this->Header_transaksi_model->listing('Menunggu Pembayaran');
        $data['total_produk'] = $this->Dashboard_model->total_produk();
        $data['total_pelanggan'] = $this->Dashboard_model->total_pelanggan();
        $data['total_transaksi'] = $this->Dashboard_model->total_transaksi();
        $data['omset'] = $this->Dashboard_model->omset();
    
        return view('admin.layout.wrapper', $data);
    }
}
