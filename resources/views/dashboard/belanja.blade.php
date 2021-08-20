<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="col">


<div class="card bo-rad-15" >
   <div class="card-header"> 
      <div class="float-left "><h4 class="font-weight-bold">{{$title}}</h4><hr></div>
   
      <div class="search-product pos-relative bo4 of-hidden d-inline float-right">
         <input class="s-text7 size1 p-l-23 p-r-50" type="text" name="search-product" placeholder="Cari Transaksi...">
         <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
            <i class="fs-12 fa fa-search" aria-hidden="true"></i>
         </button>
      </div>
         
   </div>
            <div class="table-responsive">
@if(count($header_transaksi) > 0)
            <table class='table table-striped'>
               <thead class='bg-light'>
                  <tr>
                     <th>NO</th>
                     <th >KODE TRANSAKSI</th>
                     <th >TANGGAL</th>
                     <th class='text-center'>JML.ITEM</th>
                     <th>TOTAL</th>
                     <th class='text-center'>STATUS</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @php 
                     $i = 0; 
                     if($header_transaksi->currentPage() > 1) {
                        $i = ($header_transaksi->currentPage() * 5) - 5;
                     } 
                  @endphp
                  @foreach($header_transaksi as $header_transaksi1)
                  <tr>
                     <td>{{$i += 1}}</td>
                     <td>{{$header_transaksi1->kode_transaksi}}</td>
                     <td>{{date('d-m-Y', strtotime($header_transaksi1->tanggal_transaksi))}}</td>
                     <td  class='text-center'>{{$header_transaksi1->total_item}}</td>
                     <td>IDR.{{number_format($header_transaksi1->jumlah_transaksi+$header_transaksi1->ongkir)}}</td>
                     <td class='text-center'> {{$header_transaksi1->status_bayar}}</td>
                     <td class='text-center'>
                           <a href="/dashboard/detail/{{$header_transaksi1->kode_transaksi}}" class='btn btn-dark hov1 btn-sm'><i class='fa fa-eye'></i></a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            </div>

</div>
@else
   <p class="m-text15 font-weight-bold mt-3 mb-3 text-center" >Data Tidak Ada</p>
@endif
</div>
   @if(count($header_transaksi) > 0)
   <div class="pagination flex-m flex-w p-t-26 justify-content-center">
      {{$header_transaksi->links('vendor.pagination.mypagination')}}
   </div>
   @endif
</div>


</div>
<!-- row -->
</div>
<!-- container -->
</section>