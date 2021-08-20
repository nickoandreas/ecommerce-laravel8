<?php 
use App\Models\Produk_model;
$produk_model = new Produk_model;
?>

<section class="p-t-50 p-b-40 flex-col-c-m bg-light" >
   <h2 class="l-text4 t-center warna"> {{$title}} </h2>
</section>

<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">

@if(session('sukses'))
   <div class='alert alert-warning mb-3' align='center'> 
      {{session('sukses')}}
   </div>
@endif

<div class="container-table-cart pos-relative">
<div class="wrap-table-shopping-cart bgwhite">

<table class="table-shopping-cart">
   <tr class="table-head">
      <th class="column-1"></th> 
      <th class="column-2">Produk</th>
      <th class="column-3">Harga</th>
      <th class="column-4 p-l-35">Jumlah</th>
      <th class="column-5">Subtotal</th>
      <th class="column-6 " width='10%' ></th>
   </tr>


@foreach($keranjang as $keranjang)
@php 
$produk =  $produk_model->listingById($keranjang->id);
@endphp

<form action="/belanja/update/{{$keranjang->rowid}}" method="post">
@method('put')
@csrf
<input type="hidden" name="price" value="{{$keranjang->price}}">

<tr class="table-row">
   <td class="column-1">
      <div class="cart-img-product b-rad-4 o-f-hidden">
         <img src="{{asset('assets/upload/image/thumbs/'.$produk->gambar)}}" alt="{{$produk->gambar}}">
      </div>
   </td>

   <td class="column-2">{{$keranjang->name}} ({{number_format($produk->berat, '0',',','.')}} Gr) </td>

   <td class="column-4">IDR. {{number_format($keranjang->price, '0', ',', '.')}}</td>

   <td class="column-4">
   <div class="flex-w bo5 of-hidden bo-rad-23 w-size17">
      <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
         <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
      </button>
         <input class="size8 m-text18 t-center num-product" type="number" name="qty" value="{{$keranjang->qty}}">
      <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
         <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
      </button>
   </div>
   </td>

   <td class="column-5">
      IDR.{{number_format($keranjang->subtotal, '0', ',', '.')}}
   </td>

   <td>
      <a href='/belanja/hapus/{{$keranjang->rowid}}' class='btn btn-dark btn-sm'>
         <i class='fa fa-trash-o'></i>
      </a>

      <button type='submit' name='update' class='btn btn-dark btn-sm'>
         <i class='fa fa-edit'></i>
      </button>
   </td>
</tr>
</form>
@endforeach


<tr class='table-row bg-light font-weight-bold'>
   <td colspan="4" class='column-1'>Total Pembelian</td>
   <td colspan='2' class='column-2'>IDR. {{number_format($total_belanja, '0', ',', '.')}}</td>
</tr>

</table>

<p class='pull-right mt-2 mr-2'>
   <a href="/belanja/hapus" class='btn btn-dark bo-rad-20 hov1 p-l-25 p-r-25'>
       HAPUS SEMUA
   </a>

   <a href="/belanja/checkout" class='btn btn-dark bo-rad-20 hov1 p-l-25 p-r-25'>
      CHECKOUT
   </a>
</p>


</div>
<!-- /wrap table -->
<div class="flex-w flex-sb-m p-t-10 bo8 p-l-35 p-r-60 p-lr-15-sm "></div>
</div>
<!-- /container table -->
</div>
<!-- /container -->
</section>