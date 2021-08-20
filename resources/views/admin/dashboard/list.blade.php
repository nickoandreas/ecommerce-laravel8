 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content">  
<div class="container-fluid">

   <!-- sweet alert -->
   <div class="flash-batal-pesanan" 
      data-flashdata="{{session('flash')}}">
   </div>

<div class='row mt-3'>


   <div class="col-lg-3"> 
      <!-- small box -->
      <div class="small-box bg-info">
         <div class="inner">
            <h3>{{$total_produk->total_produk}}</h3>

            <p>PRODUK</p>
         </div>
         <div class="icon">
            <i class="fa fa-book-open"></i>
         </div>
      </div>
   </div>
      <!-- ./col -->

   <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
         <div class="inner">
            <h3>{{$total_pelanggan->total_pelanggan}}</h3>

            <p>PELANGGAN</p>
         </div>
         <div class="icon">
            <i class="fa fa-user-astronaut"></i>
         </div>
      </div>
   </div>
      <!-- ./col -->

   <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-secondary">
         <div class="inner">
            <h3>{{$total_transaksi->total_transaksi}}</h3>

            <p>TRANSAKSI</p>
         </div>
         <div class="icon">
            <i class="fa fa-shopping-cart"></i>
         </div>
      </div>
   </div>
       <!-- ./col -->

   <div class="col-lg-3 col-6">
       <!-- small box -->
      <div class="small-box bg-danger">
         <div class="inner">
         @if($omset >= 1000)
            <h3>{{number_format($omset/1000, '0', ',', '.')}} K</h3>
         @elseif($omset >= 1000000)
            <h3>{{number_format($omset/1000000, '0', ',', '.')}} M</h3>
         @elseif($omset >= 1000000000 )
            <h3>{{number_format($omset/1000000000, '0', ',', '.')}} B</h3>
         @elseif($omset == 0)
            <h3>{{$omset}}</h3>
         @endif
            <p>OMSET</p>
         </div>
         <div class="icon">
            <i class="fa fa-dollar-sign"></i>
         </div>
      </div>
   </div>
      <!-- ./col -->


</div>

<div class="row">
<div class="col-12"> 
<div class="card mt-3">

<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >PESANAN MASUK</h3>
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

               <a href="/admin/transaksi/hapus/{{$header_transaksi->kode_transaksi}}" class="  bg-danger dropdown-item tombolHapus"><i class="fa fa-times "></i> Batalkan</a>

               <a href="/admin/transaksi/detail/{{$header_transaksi->kode_transaksi}}" class="bg-success dropdown-item "><i class="fa fa-eye"></i> Detail Transaksi </a>

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
</div>
</div>
</section>
</div>
