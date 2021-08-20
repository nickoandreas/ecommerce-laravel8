<!-- logo -->
@php
use App\Models\Produk_model;
$produk_model = new Produk_model;
@endphp
<div class="wrap_header">
   <a href="index-2.html" class="logo">
      <img src="{{asset('assets/upload/image/'.$data['konfigurasi']->icon)}}" alt="{{$data['konfigurasi']->namaweb}}-LOGO"  >
   </a>
<div class="wrap_menu">
<nav class="menu">
<ul class="main_menu">

   <!-- Beranda -->
   <li>
      <a class="color0-hov animsition-link" data-animsition-out-class="zoom-out-lg" href="/">Beranda</a>
   </li> 

   <!-- Semua Produk -->
   <li>
      <a class="color0-hov animsition-link" data-animsition-out-class="fade-out-left-sm" href="/produk">Semua Produk</a>
   </li>
   
   <!-- Motor -->
   <li>
      <a class="color0-hov animsition-link" data-animsition-out-class="fade-out-right-sm" href="/produk/parts_motor">Parts Motor</a>
   </li>

   <!-- Mobil -->
   <li>
      <a class="color0-hov animsition-link" data-animsition-out-class="flip-out-y-fr" href="/produk/parts_mobil">Parts Mobil</a>
   </li>

   <li>
      <a class="color0-hov nav-cari" data-toggle="collapse"  href="#collapseExample" role="button" > Cari Produk
      </a>
   </li>
</ul>

</nav>

<!-- collapse cari produk -->
<div class="collapse collapsing " id="collapseExample">
<div class="search-product pos-relative of-hidden">

   <div class="input-group">
      <input class="s-text7 size6 p-l-23 p-r-50 border border-dark" type="text" name="search-product" placeholder="Cari Produk..." id="keyword" autocomplete="off"> 

      <span  class="flex-c-m size5 ab-r-m "> 
         <i class="fs-12 fa fa-search"></i>
      </span> 
   </div>

   <ul class="list-group" id='result'></ul>
</div>
</div>

</div>

<!-- dashboar / nama user -->
<div class="header-icons">
   @if(session('email') && session('nama_pelanggan') != '')
      <a  class="header-wrapicon1 dis-block">
         <img src="{{asset('assets/template/images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
      </a>  

      <div class="wrap_menu">
      <nav class="menu">
      <ul class="main_menu">
      <li>
         <a >{{session('nama_pelanggan')}}</a>
         <ul class="sub_menu">
            <li >
               <a href="/dashboard"> <i></i>Konfirmasi Pembayaran</a>
            </li>
            <li>
               <a href="/belanja"> <i></i> Keranjang Belanja</a>
            </li>
            <li>
               <a  href="/dashboard/belanja"> <i ></i> PesananKu</a>
            </li>
            <li>
               <a  href="/dashboard/profile"> <i ></i> ProfileKu</a>
            </li>
            <li>
               <a  href="/logout"> <i ></i> Keluar</a>
            </li>
         </ul>
      </li>
      </ul>
      </nav>
      </div>
      
   @else

      <a  class="header-wrapicon1 dis-block">
         <img src="{{asset('assets/template/images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
      </a>

      <div class="wrap_menu">
      <nav class="menu">
      <ul class="main_menu">
      <li>
         <a >Belum Terdaftar</a>
         <ul class="sub_menu">
            <li>
               <a href="/registrasi">Registrasi</a>
            </li>
            <li>
               <a href="/login">Masuk</a>
            </li>
         </ul>
      </li>
      </ul>
      </nav>
      </div>
      
   @endif


<!-- cart nav-->
@php $jumlah_item = count($keranjang_nav) @endphp
<span class="linedivide1"></span>
<div class="header-wrapicon2">   

<img src="{{asset('assets/template/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
<span class="header-icons-noti">{{$jumlah_item}}</span>
<div class="header-cart header-dropdown">

<ul class="header-cart-wrapitem">

@if($jumlah_item == 0)

   <li class="header-cart-item">
      <p class='alert alert-secondary ml-3'>Ups Keranjang Anda Kosong !!</p>
   </li>

@else

@for($i=0; $i < $jumlah_item; $i++)
@php 
$keranjang = $keranjang_nav[$i];
$produk = $produk_model->listingById($keranjang->id);
@endphp
<li class="header-cart-item">

   <div class="header-cart-item-img">
      <img src="{{asset('assets/upload/image/thumbs/'.$produk->gambar)}}" alt="{{$keranjang->name}}">
   </div>

   <div class="header-cart-item-txt">
      <a href="/produk/detail/{{$produk->slug_produk}}" class="header-cart-item-name">
         {{$keranjang->name}}
      </a>
      <span class="header-cart-item-info">
         {{$keranjang->qty}} x {{number_format($keranjang->price, '0',',','.' )}} = IDR.{{number_format($keranjang->subtotal, '0',',','.' )}}
      </span>
   </div>
</li>
@endfor
@endif
</ul>

<div class="header-cart-total">Total: {{number_format($total_belanja, '0',',','.' )}}</div>

<div class="header-cart-buttons">

   <div class="header-cart-wrapbtn">
      <a href="/belanja" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">LIHAT</a>
   </div>

   <div class="header-cart-wrapbtn">
      <a href="/belanja/checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">Check Out</a>
   </div>

</div>

</div>
<!-- /header cart -->
</div>
<!-- /header wrap-icon -->
</div>
<!-- /heade-icon -->
</div>
<!-- /wrap-header -->
</div>

<!-- header mobile -->
<div class="wrap_header_mobile">


<a href="index-2.html" class="logo-mobile">
   <img src="{{asset('assets/upload/image/'.$data['konfigurasi']->icon)}}" alt="{{$data['konfigurasi']->namaweb}}-LOGO"  >
</a>

<div class="btn-show-menu">
<div class="header-icons-mobile">

<div class="mt-1"> 
   <a class="nav-cari-mobile" data-toggle="collapse"  href="#collapseExample2" role="button" >
      <span class="fs-23 fa fa-search"></span>
   </a>
</div>

<!-- cart nav mobile -->
<span class="linedivide2"></span>
<div class="header-wrapicon2">

<img src="{{asset('assets/template/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON"> 
<span class="header-icons-noti">{{$jumlah_item}}</span>

<div class="header-cart header-dropdown">

<ul class="header-cart-wrapitem">
   @if($jumlah_item == 0)
      <li class="header-cart-item">
         <p class='alert alert-secondary ml-3 text-center'>Ups Keranjang Anda Kosong !!</p>
      </li>
   @else

   @for($i=0; $i < $jumlah_item; $i++)
   @php 
   $keranjang = $keranjang_nav[$i];
   $produk = $produk_model->listingById($keranjang->id);
   @endphp
   <li class="header-cart-item">
      <div class="header-cart-item-img">
         <img src="{{asset('assets/upload/image/thumbs/'.$produk->gambar)}}" alt="{{$keranjang->name}}">
      </div>

      <div class="header-cart-item-txt">
         <a href="/produk/detail/{{$produk->slug_produk}}" class="header-cart-item-name">
            {{$keranjang->name}}
         </a>
         <span class="header-cart-item-info">
            {{$keranjang->qty}} x {{number_format($keranjang->price, '0',',','.' )}} = IDR.{{number_format($keranjang->subtotal, '0',',','.' )}}
         </span>
      </div>
   </li>
   @endfor

   @endif
</ul>

<div class="header-cart-total">Total: {{number_format($total_belanja, '0',',','.' )}}</div>

<div class="header-cart-buttons">
   <div class="header-cart-wrapbtn">
      <a href="/belanja" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">LIHAT</a> 
   </div>

   <div class="header-cart-wrapbtn">
      <a href="/belanja/checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">Check Out</a>
   </div>
</div>

</div>
</div>
</div>
   <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
      <span class="hamburger-box">
         <span class="hamburger-inner"></span>
      </span>
   </div>
</div>
</div>

<!-- collapse cari produk -->
<div class="collapse collapsing overflow-hidden" id="collapseExample2">
<div class="search-product pos-relative of-hidden">
   
   <div class="input-group">
      <input class="s-text7 size2 p-l-23 p-r-50 border border-dark bo-rad-25" type="text" name="search-product" placeholder="Cari Produk..." id="keyword-mobile" autocomplete="off"> 

      <span  class="flex-c-m size5 ab-r-m "> 
         <i class="fs-12 fa fa-search"></i>
      </span> 
   </div>

   
   <ul class="list-group" id='result-mobile' > 
      
   </ul>
   
</div>
</div>

<div class="wrap-side-menu">
<nav class="side-menu">
<ul class="main-menu">

<!-- topbar sosial media -->
<li class="item-topbar-mobile p-l-10">
<div class="topbar-social-mobile">
   <a href="{{$data['konfigurasi']->facebook}}" target="_blank" class="topbar-social-item fa fa-facebook"></a>
   <a href="{{$data['konfigurasi']->instagram}}" target="_blank" class="topbar-social-item fa fa-instagram"></a>
   <a href="https://www.youtube.com/channel/UCgiZeBV4xi8KdY9VmVKgUQw" target="blank" class="topbar-social-item fa fa-youtube-play"></a>
   @if(session('email'))
      <span class="topbar-child1 pull-right mr-3"><i class="topbar-social-item fa fa-user-circle"></i>{{session('nama_pelanggan')}}</span>
   @else
      <span class="topbar-child1 pull-right mr-3"><i class="topbar-social-item fa fa-user-circle "></i><a href="/registrasi"> Belum Terdaftar</a></span>
   @endif
</div>
</li>

<!-- navigasi bar -->
<li class="item-menu-mobile">
   <a href="/" class="animsition-link" data-animsition-out-class="zoom-out-lg">Beranda</a>
</li>

<li class="item-menu-mobile">
   <a href="/produk" class="animsition-link" data-animsition-out-class="fade-out-left-sm">Semua Produk</a>
</li>

<!-- Motor -->
<li class="item-menu-mobile">
   <a href="/produk/parts_motor" class="animsition-link" data-animsition-out-class="fade-out-right-sm">Parts Motor</a>
</li>

<!-- Mobil -->
<li class="item-menu-mobile">
   <a href="/produk/parts_mobil" data-animsition-out-class="flip-out-y-fr" class="animsition-link" >Parts Mobil</a>
</li>

@if(session('email'))
<li class="item-menu-mobile">
   <a>MenuKu</a>
   <ul class="sub-menu">
      <li><a href="/dashboard">Konfrimasi Pembayaran</a></li>
      <li><a href="/belanja">Keranjang Belanja</a></li>
      <li><a href="/dashboard/belanja">PesananKu</a></li>
      <li><a href="/dashboard/profile">ProfileKu</a></li>
   </ul>
   <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
</li>

@else

<li class="item-menu-mobile">
   <a>MenuKu</a>
   <ul class="sub-menu">
      <li><a href="/registrasi">Registrasi</a></li>
      <li><a href="/login">Masuk</a></li>
   </ul>
   <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
</li>
@endif

@if(session('email'))
<li class="item-menu-mobile">
   <a href="/logout">Keluar</a>
</li>
@endif

</ul>
</nav>
</div>
</header>
