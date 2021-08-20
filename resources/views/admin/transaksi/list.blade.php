<div class="content-wrapper">

  <!-- sweet alert -->
   <div class="flash-status" 
      data-flashdata="{{session('flash')}}">
   </div>

<section class="content ">
<div class="container-fluid">
<div class="row">
<div class="col-12"> 
<div class="card mt-3">

<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >PESANAN YANG TELAH DIBAYAR</h3>
</div>

<div class="card-body ">

<table id="example1" class="table table-bordered">

<thead class="bg-secondary ">
   <tr>
      <th class="text-center">NO</th>
      <th class="text-center">ACTION</th>
      <th>PELANGGAN</th>
      <th>TANGGAL</th>
      <th>KODE</th>
      <th >JML.ITEM</th>
      <th>JML.TOTAL</th>
      <th>STATUS</th>
      <th>NP.HP</th>
      <th>EMAIL</th>
      <th>ALAMAT</th>
      
   </tr>
</thead>

<tbody class="bg-dark " >
   @foreach($header_transaksi as $header_transaksi)
   <tr>
      <td class=" text-center">{{$loop->iteration}}</td>
      <td class=" text-center ">

         <div class="dropdown">
            <button class="btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Action
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

               <a href="/admin/transaksi/konfirmasi/{{$header_transaksi->kode_transaksi}}" class="bg-success dropdown-item"><i class="fa fa-check "></i> Konfrimasi Pembayaran</a>

               <a href="/admin/transaksi/detail/{{$header_transaksi->kode_transaksi}}" class="  bg-danger dropdown-item "><i class="fa fa-eye"></i> Detail Transaksi </a>

               <a href="{{url('/admin/transaksi/detail_pdf/'.$header_transaksi->kode_transaksi)}}" target='_blank' class="  bg-info  dropdown-item"><i class="fa fa-file-pdf"></i> Print Detail Transaksi </a>

            </div>
         </div>


      </td>
      <td>{{$header_transaksi->nama_pelanggan}}</td>
      <td>@php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) @endphp</td>
      <td> {{$header_transaksi->kode_transaksi }}</td>
      <td class='text-center'>{{$header_transaksi->total_item}}</td>
      <td>IDR.    @php echo number_format($header_transaksi->jumlah_transaksi+$header_transaksi->ongkir, '0',',','.') @endphp</td>
      <td>{{$header_transaksi->status_bayar}}</td>
      <td>{{$header_transaksi->telepon}}</td>
      <td>{{$header_transaksi->email}}</td>
      <td>{{$header_transaksi->alamat}}, {{$header_transaksi->kota}}, {{$header_transaksi->provinsi}}</td>

   </tr>
   @endforeach
</tbody>

</table>


</div>
   <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->