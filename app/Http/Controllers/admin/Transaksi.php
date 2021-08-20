<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_transaksi_model;
use App\Models\Transaksi_model;
use App\Models\Rekening_model;
use App\Models\Konfigurasi_model;

class Transaksi extends Controller
{   
    
    public function __construct()
    {
       $this->Header_transaksi_model = new Header_transaksi_model();
       $this->Transaksi_model = new Transaksi_model;
       $this->Rekening_model = new Rekening_model;
       $this->Konfigurasi_model = new Konfigurasi_model;
       $this->middleware('preventBackHistory');
    }
    
    public function index()
    {
        $data['title'] = 'Pesanan Dibayar';
        $data['isi'] = 'admin.transaksi.list';
        $data['header_transaksi'] = $this->Header_transaksi_model->listing('Menunggu Konfirmasi Admin');
        
        return view('admin.layout.wrapper', $data);
    }

    public function packing()
    {
        $data['title'] = 'Pesanan Dikemas';
        $data['isi'] = 'admin.transaksi.packing';
        $data['header_transaksi'] = $this->Header_transaksi_model->listing('Proses Pengemasan');

        return view('admin.layout.wrapper', $data);
    }

    public function kirim()
    {
        $data['title'] = 'Pesanan Dikirim';
        $data['isi'] = 'admin.transaksi.dikirim';
        $data['header_transaksi'] = $this->Header_transaksi_model->listing('Pesanan Dalam Pengiriman');

        return view('admin.layout.wrapper', $data);
    }

    public function diterima()
    {
        $data['title'] = 'Pesanan Diterima';
        $data['isi'] = 'admin.transaksi.diterima';
        $data['header_transaksi'] = $this->Header_transaksi_model->listing('Pesanan Sudah Diterima');

        return view('admin.layout.wrapper', $data);
    }

    // action
    public function delete($kode_transaksi)
    {
        $this->Transaksi_model->hapus_transaksi($kode_transaksi);
        $this->Header_transaksi_model->hapus_transaksi($kode_transaksi);
        $this->Transaksi_model->hapus_pengiriman($kode_transaksi);
        return redirect('/admin/dashboard')->with('flash', 'Dibatalkan');
    }

    public function detail($kode_transaksi)
    {   
        $header_transaksi = $this->Header_transaksi_model->listingByKode($kode_transaksi);
        $data['title'] = 'Detail Transaksi';
        $data['isi'] = 'admin/transaksi/detail';
        $data['header_transaksi'] = $header_transaksi;
        $data['transaksi'] = $this->Transaksi_model->listingByKode($kode_transaksi);
        $data['rekening'] = $this->Rekening_model->listingById($header_transaksi->id_rekening);
        
        return view('admin.layout.wrapper', $data);

    }

    public function detail_pdf($kode_transaksi)
    {
        $header_transaksi = $this->Header_transaksi_model->listingByKode($kode_transaksi);
        $data['title'] = 'Detail Transaksi';
        $data['header_transaksi'] = $header_transaksi;
        $data['transaksi'] = $this->Transaksi_model->listingByKode($kode_transaksi);
        $data['rekening'] = $this->Rekening_model->listingById($header_transaksi->id_rekening);
        $html = view('admin.transaksi.cetak', $data);
        dump($data['rekening']); die;
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $nama_file = 'Detail-Transaksi'. '-' .$kode_transaksi;
        return $mpdf->Output($nama_file, 'I');
    }

    public function invoice($kode_transaksi)
    {
        $header_transaksi = $this->Header_transaksi_model->listingByKode($kode_transaksi);
        $konfigurasi = $this->Konfigurasi_model->listing();
        $data['title'] = 'Invoice Transaksi';
        $data['header_transaksi'] = $header_transaksi;
        $data['transaksi'] = $this->Transaksi_model->listingByKode($kode_transaksi);
        $data['rekening'] = $this->Rekening_model->listingById($header_transaksi->id_rekening);
        $data['konfigurasi'] = $konfigurasi;
        $html = view('admin/transaksi/invoice', $data);

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetHTMLHeader('
        <div style="text-align: left; font-weight: bold;">
            <img src="'.public_path('assets/upload/image/'.$konfigurasi->icon).'" style="height:50px; width:auto;" >
        </div>');

        $mpdf->SetHTMLFooter('
        <div style="padding:10px 20px; background-color:black; color:white; font-size:12px;" >
            Alamat     : '.$konfigurasi->namaweb.' ('.$konfigurasi->alamat.')<br>
            No.Telepon : '.$konfigurasi->telepon.' 
        </div>
        ');
    
        $mpdf->WriteHTML($html);
        $nama_file = 'Invoice'.'-'.$kode_transaksi;
        return $mpdf->Output($nama_file, 'I');
    }

    public function konfirmasi($kode_transaksi)
    {
        $this->Header_transaksi_model->update_status($kode_transaksi, 'Proses Pengemasan');
        return redirect('/admin/transaksi')->with('flash', 'Dikonfirmasi');
    }

    public function pengiriman($kode_transaksi)
    {
        $pengiriman = $this->Transaksi_model->data_pengiriman($kode_transaksi);
        if($pengiriman->resi == "") {
           return redirect('admin/transaksi/packing')->with('flash-cek', 'Maaf Masukan No Resi Terlebih Dahulu');
        }
        $this->Header_transaksi_model->update_status($kode_transaksi, 'Pesanan Dalam Pengiriman');
        return redirect('/admin/transaksi/packing')->with('flash', 'Diperbarui');
    }

    public function pesanan_sampai($kode_transaksi)
    {
        $this->Header_transaksi_model->update_status($kode_transaksi, 'Pesanan Sudah Diterima');
        return redirect('/admin/transaksi/kirim')->with('flash', 'Diperbarui');
    }

    public function resi($kode_transaksi)
    {
        $this->Transaksi_model->resi($kode_transaksi);
        return redirect('/admin/transaksi/packing')->with('flash-resi', 'Dimasukan');
    }
}
