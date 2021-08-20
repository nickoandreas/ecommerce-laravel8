<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- icon -->
   <link rel="icon" type="image/png" href="{{asset('assets/upload/image/'.$data['konfigurasi']->icon)}}" >
   <title>{{$title}}</title>
   
   <style type='text/css' media='print'>
      body {
         font-family: Arial;
         font-size: 12px;
      }

      table {
         border: solid;
         border-collapse: collapse;
      }

      td, th {
         padding: 3mm 6mm;
         text-align: left;
         vertical-align: top;
      }

      th {
         background-color: #f5f5f5;
         font-weight: bold;
      }

      .cetak {
         width: 19cm; 
         height: 27cm;
         padding: 1cm;
      }

      h1 {
         text-align: center;
         font-size: 18px;
         text-transform: uppercase;
      }
   
   </style>

<style type='text/css' media='screen'>
      body {
         font-family: Arial;
         font-size: 12px;
      }

      table {
         border: solid;
         border-collapse: collapse;
         width: 100%;

      }

      td, th {
         padding: 3mm 6mm;
         text-align: left;
         vertical-align: top;
      }

      th {
         background-color: #f5f5f5;
         font-weight: bold;
      }

      .cetak {
         width: 19cm; 
         height: 27cm;
         padding: 1cm;
      }

      h1 {
         text-align: center;
         font-size: 18px;
         text-transform: uppercase;
         margin-left: 2px;
      }
   
   </style>
</head>
<body>
   <div class='cetak'>
      <h1>DETAIL TRANSAKSI {{$data['konfigurasi']->namaweb}}</h1>

      <table width='130%'>
      <thead>
         <tr>
            <td width='20%'>Nama Pelanggan</td>
            <td>: {{$header_transaksi->nama_pelanggan}}</td>
         </tr>
         <tr>
            <td width='20%'>Kode Transaksi</td>
            <td>: {{$header_transaksi->kode_transaksi}}</td>
         </tr>
      </thead>
      <tbody >
         <tr>
            <td>Tanggal Checkout</td>
            <td>: {{date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi))}}</td>
         </tr>
         <tr>
            <td>Tanggal Bayar</td>
            <td>: @php if(isset($header_transaksi->tanggal_bayar)) {echo date('d-m-Y', strtotime($header_transaksi->tanggal_bayar)); } else { echo 'Belum Melakukan Konfirmasi Pembayaran';} @endphp </td>
         </tr>
         <tr>
            <td>Tanggal Kirim</td>
            @if($header_transaksi->tanggal_kirim != NULL)
               <td>: {{date('d-m-Y', strtotime($header_transaksi->tanggal_kirim))}}</td>
            @else
               <td>: Pesanan Belum Dikirim</td>
            @endif
         </tr>
         <tr>
            <td>Status</td>
            <td>: {{$header_transaksi->status_bayar}}</td>
         </tr>
         <tr>
            <td>Bukti Pembayaran</td>
            @if($header_transaksi->bukti_bayar != NULL)
               <td>
                  <img src="{{asset('assets/upload/image/thumbs/bukti_pembayaran/'.$header_transaksi->bukti_bayar)}}" class='img img-thumbnail' width='150'>
               </td>
            @else
               <td>: Tidak Ada Bukti Pembayaran</td>
            @endif
         </tr>
         <tr>
               <td>Total Belanja</td>
               <td>: IDR. {{number_format($header_transaksi->jumlah_transaksi, '0','.','.')}} </td>
         </tr>
         <tr>
               <td>Ongkos Kirim</td>
               <td>: IDR. {{number_format($header_transaksi->ongkir, '0','.','.')}} ({{strtoupper($header_transaksi->expedisi)}} {{$header_transaksi->layanan}} {{ number_format($header_transaksi->berat, '0',',','.')}} Gr)</td>
         </tr>
         <tr>
               <td>Total Transaksi</td>
               <td>: IDR. {{number_format($header_transaksi->ongkir+$header_transaksi->jumlah_transaksi, '0','.','.')}}</td>
         </tr>
         <tr>
            <td>Jumlah Bayar</td>
            @if($header_transaksi->jumlah_bayar != NULL)
               <td>: IDR. {{number_format($header_transaksi->jumlah_bayar, '0','.','.')}}</td>
            @else
               <td>: Belum Melakukan Konfirmasi Pembayaran</td>
            @endif
         </tr>
         <tr>
            <td>No Resi</td>
            @if($header_transaksi->resi != NULL)
               <td>: {{$header_transaksi->resi}} </td>
            @else
               <td>: Pesanan Belum Dikirm</td>
            @endif
         </tr>
         <tr>
            <td>Pembayaran Dari</td>
            @if($header_transaksi->jumlah_bayar != NULL)
               <td>: {{$header_transaksi->nama_bank}} No.Rekening {{$header_transaksi->rekening_pembayaran }} a/n {{ $header_transaksi->rekening_pelanggan}} </td>
            @else
               <td>: Belum Melakukan Konfirmasi Pembayaran</td>
            @endif
         </tr>
         <tr>
            <td>Pembayaran Rekening</td>
            @if($header_transaksi->jumlah_bayar != NULL)
               <td>: {{$rekening->nama_bank}} No.Rekening {{$rekening->nomor_rekening}} a/n {{$rekening->nama_pemilik}}</td>
            @else
               <td>: Belum Melakukan Konfirmasi Pembayaran</td>
            @endif
         </tr>
      </tbody>
   </table>
   <br>
   <table width='130%' >
      <thead >
         <tr >
            <th>NO</th>
            <th>KODE PRODUK</th>
            <th width='35%'>NAMA PRODUK</th>
            <th>JUMLAH</th>
            <th>HARGA</th>
            <th>SUB TOTAL</th>
         </tr>
      </thead>
      <tbody >
         @foreach($transaksi as $transaksi)
            <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$transaksi->kode_produk}}</td>
               <td >{{$transaksi->nama_produk}}</td>
               <td>{{number_format($transaksi->jumlah, '0', ',', '.')}}</td>
               <td>IDR.{{number_format($transaksi->harga, '0', ',', '.')}}</td>
               <td>IDR.{{number_format($transaksi->total_harga, '0', ',', '.')}}</td>
            </tr>
         @endforeach
         <tr>
            <td colspan='5' style='text-align: center;'>TOTAL BELANJA</td>
            <td>IDR.{{number_format($header_transaksi->jumlah_transaksi, '0', ',', '.')}}</td>
         </tr>
      </tbody>
   </table>
   </div>

   
</body>
</html>