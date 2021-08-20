<section class=" p-t-50 p-b-40 flex-col-c-m bg-light">
   <h2 class="l-text4 t-center warna"> {{$title}} </h2>
   @if(isset($kategori))
      <h4 class="m-text13 t-center warna">{{$kategori}}</h4>
   @endif
   <p class="m-text13 t-center warna"> {{$data['konfigurasi']->tagline}}</p>
</section>

<div class="flash-cart" 
      data-flashdata="{{session('flash-cart2')}}">
</div>

<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="row">

<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
<div class="leftbar p-r-20 p-r-0-sm">

<div class="wrap_menu">
<nav class="menu">
<ul class="main_menu">
<li>
   <p class="m-text15 font-weight-bold" >Kategori Parts Motor</p>
   <ul class="sub_menu">
   @for($i=0; $i < count($data['kategori2']); $i++ )
   @php $kategori = $data['kategori2'][$i] @endphp
      <li>
         <a href="/produk/kategori2/{{$kategori->slug_kategori}}" >
            {{$kategori->nama_kategori}}
         </a>
      </li>
   @endfor
   </ul>
</li>
</ul>
</nav>
</div>

<div class="wrap_menu">
<nav class="menu">
<ul class="main_menu">
<li>
   <p class="m-text15 font-weight-bold" >Kategori Parts Mobil</p>
   <ul class="sub_menu">
   @for($i=0; $i < count($data['kategori4']); $i++ )
   @php $kategori = $data['kategori4'][$i] @endphp
      <li>
         <a href="/produk/kategori4/{{$kategori->slug_kategori}}">
            {{$kategori->nama_kategori}}
         </a>
      </li>
   @endfor
   </ul>
</li>
</ul>
</nav>
</div>

</div>
</div>

<!-- content produk -->
<div class="col-sm-6 col-md-8 col-lg-9 p-b-50" id="content-produk">
<div class="row">
   
@if(count($produk) > 0)
@foreach($produk as $produk1)
@php $periode = strtotime($produk1->tanggal_post) + (30*60*60*24) @endphp

<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
<div class="block2">

<form action="/belanja" method='post'>
   @csrf
   <input type="hidden" name='id' value='{{$produk1->id_produk}}' >
   <input type="hidden" name='qty' value=1 >
   @if(strtotime($produk1->tanggal_mulai_diskon) <= strtotime(date('Y-m-d')) && strtotime($produk1->tanggal_akhir_diskon) >= strtotime(date('Y-m-d')))
      <input type="hidden" name='price' value='{{$produk1->harga_diskon}}'>
   @else
      <input type="hidden" name='price' value='{{$produk1->harga}}'>
   @endif
   <input type="hidden" name='name' value='{{$produk1->nama_produk}}'>
   <input type="hidden" name='redirect_page' value='{{ url()->current() }}'>

   @if(strtotime($produk1->tanggal_mulai_diskon) <= strtotime(date('Y-m-d')) && strtotime($produk1->tanggal_akhir_diskon) >= strtotime(date('Y-m-d')))
      <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
   @elseif($periode >= time())
      <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
   @else
      <div class="block2-img wrap-pic-w of-hidden pos-relative">
   @endif

         <img src="{{asset('assets/upload/image/thumbs/'.$produk1->gambar)}}" alt="{{$produk1->gambar}}">

      <div class="block2-overlay trans-0-4">
         <div class="block2-btn-addcart w-size1 trans-0-4">
            <button type='submit' value='submit' class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
               <span class="fa fa-plus"> Keranjang</span>
            </button>
         </div>
      </div>

   </div>

   <div class="block2-txt p-t-20">
   
      <a href="/produk/detail/{{$produk1->slug_produk}}" class="block2-name dis-block s-text3 p-b-5">
         {{$produk1->nama_produk}}
      </a>

      @if(strtotime($produk1->tanggal_mulai_diskon) <= strtotime(date('Y-m-d')) && strtotime($produk1->tanggal_akhir_diskon) >= strtotime(date('Y-m-d')))
         <span class="block2-oldprice m-text7 p-r-5">
            IDR {{number_format($produk1->harga, '0', ',', '.')}}
         </span>
         <span class="block2-newprice m-text8 p-r-5">
            IDR {{number_format($produk1->harga_diskon, '0', ',', '.')}}
         </span>
      @else
         <span class="block2-price m-text6 p-r-5">
            IDR {{number_format($produk1->harga, '0', ',', '.')}}
         </span>
      @endif

   </div>

</div>
</div>
</form>
@endforeach

@else
   <p class="m-text17 font-weight-bold mx-auto" >Data Tidak Ada</p>
@endif

</div>
   
   @if(count($produk) > 0)
      <div class="pagination flex-m flex-w p-t-26 justify-content-center">
         {{$produk->links('vendor.pagination.mypagination')}}
      </div>
   @endif

</div>

</div>
<!-- row -->
</div>
<!-- container -->
</section>