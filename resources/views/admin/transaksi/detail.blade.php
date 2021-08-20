<div class="content-wrapper">

<section class="content ">
<div class="container-fluid">
<div class="row">
<div class="col-12"> 
<div class="card  mt-3 ">

<div class="card-header bg-dark ">
   <h3 class="card-title font-weight-bold" >DETAIL TRANSAKSI</h3>
</div>

<div class="card-body ">

   <table class='table table-bordered '>
      <thead class='bg-dark'>
         <tr>
            <td width='20%'>Nama Pelanggan</td>
            <td>: {{$header_transaksi->nama_pelanggan}}</td>
         </tr>
         <tr>
            <td width='20%'>Kode Transaksi</td>
            <td>: {{$header_transaksi->kode_transaksi}}</td>
         </tr>
      </thead>
      <tbody class='bg-dark'>
         <tr>
            <td>Tanggal Checkout</td>
            <td>: @php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) @endphp</td>
         </tr>
         <tr>
            <td>Tanggal Bayar</td>
            <td>: @php if(isset($header_transaksi->tanggal_bayar)) {echo date('d-m-Y', strtotime($header_transaksi->tanggal_bayar)); } else { echo 'Belum Melakukan Konfirmasi Pembayaran';} @endphp </td>
         </tr>
         <tr>
            <td>Tanggal Kirim</td>
            @if($header_transaksi->tanggal_kirim != NULL)
               <td>: @php echo date('d-m-Y', strtotime($header_transaksi->tanggal_kirim)) @endphp</td>
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
               <td>: IDR. @php echo number_format($header_transaksi->jumlah_transaksi, '0','.','.') @endphp </td>
         </tr>
         <tr>
               <td>Ongkos Kirim</td>
               <td>: IDR. {{number_format($header_transaksi->ongkir, '0','.','.')}} ( {{strtoUpper($header_transaksi->expedisi)}} {{$header_transaksi->layanan}} {{number_format($header_transaksi->berat, '0',',','.')}} Gr)</td>
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
               <td>: {{$header_transaksi->resi}}</td>
            @else
               <td>: Pesanan Belum Dikirm</td>
            @endif
         </tr>
         <tr>
            <td>Pembayaran Dari</td>
            @if($header_transaksi->jumlah_bayar != NULL)
               <td>: {{$header_transaksi->nama_bank}} No.Rekening {{$header_transaksi->rekening_pembayaran}} a/n {{$header_transaksi->rekening_pelanggan}} </td>
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

   <table class='table table-bordered' width='100%'>
      <thead class='bg-secondary'>
         <tr >
            <th>NO</th>
            <th>KODE PRODUK</th>
            <th>NAMA PRODUK</th>
            <th>JUMLAH</th>
            <th>HARGA</th>
            <th>SUB TOTAL</th>
         </tr>
      </thead>
      <tbody class='bg-dark'>
         @foreach($transaksi as $transaksi)
         <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$transaksi->kode_produk}}</td>
            <td>{{$transaksi->nama_produk}}</td>
            <td>{{number_format($transaksi->jumlah, '0', ',', '.')}}</td>
            <td>IDR.{{number_format($transaksi->harga, '0', ',', '.')}}</td>
            <td>IDR.{{number_format($transaksi->total_harga, '0', ',', '.')}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

</div>
</div>
</section>
</div>
</div>
</div>
</div>