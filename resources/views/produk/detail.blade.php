<div class="flash-cart" 
      data-flashdata="{{session('flash-cart2')}}">
</div>

<div class="container bgwhite p-t-35 p-b-80">
<div class="flex-w flex-sb">

<div class="w-size13 p-t-30 respon5">
<div class="wrap-slick3 flex-sb flex-w">
<div class="wrap-slick3-dots"></div>
<div class="slick3">
   <div class="item-slick3" data-thumb="{{asset('assets/upload/image/thumbs/'.$produk->gambar)}}">
      <div class="wrap-pic-w">
         <img src="{{asset('assets/upload/image/'.$produk->gambar)}}" alt="{{$produk->gambar}}">
      </div>
   </div>

   @if($gambar)
   @foreach($gambar as $gambar)
   <div class="item-slick3" data-thumb="{{asset('assets/upload/image/thumbs/'.$gambar->gambar)}}">
      <div class="wrap-pic-w">
         <img src="{{asset('assets/upload/image/'.$gambar->gambar)}}" alt="{{$gambar->judul_gambar}}">
      </div>
   </div>
   @endforeach
   @endif
</div>
</div>
</div>

<div class="w-size14 p-t-30 respon5">
   <h1 class="product-detail-name m-text20 p-b-13">
      {{$produk->nama_produk}}
   </h1>
   
<form action="/belanja" method='post'>
@csrf
<input type="hidden" name='id' value='{{$produk->id_produk}}' >
@if(strtotime($produk->tanggal_mulai_diskon) <= strtotime(date('Y-m-d')) && strtotime($produk->tanggal_akhir_diskon) >= strtotime(date('Y-m-d')))
   <input type="hidden" name='price' value='{{$produk->harga_diskon}}'>
@else
   <input type="hidden" name='price' value='{{$produk->harga}}'>
@endif
<input type="hidden" name='name' value='{{$produk->nama_produk}}'>
<input type="hidden" name='redirect_page' value='{{url()->current()}}'>

   @if(strtotime($produk->tanggal_mulai_diskon) <= strtotime(date('Y-m-d')) && strtotime($produk->tanggal_akhir_diskon) >= strtotime(date('Y-m-d')))
      <span class="block2-oldprice m-text7 p-r-5">
         IDR {{number_format($produk->harga, '0', ',', '.')}}
      </span>
      <span class="block2-newprice m-text8 p-r-5">
         IDR {{number_format($produk->harga_diskon, '0', ',', '.')}}
      </span>
   @else
      <span class="block2-price m-text6 p-r-5">
         IDR {{number_format($produk->harga, '0', ',', '.')}}
      </span>
   @endif

   <span class="m-text6 p-r-5 d-block">
         STOK: {{$produk->stok}} PCS
   </span>
   
   @if($produk->ukuran && $produk->berat != '')
      <span class="m-text6 p-r-5 d-block">
            BERAT: {{$produk->berat}} GRAM
      </span>

      <span class="m-text6 p-r-5 d-block">
            UKURAN: {{$produk->ukuran}}
      </span>
   @else
      <span class="m-text6 p-r-5 d-block">
            BERAT: {{$produk->berat}} GRAM
      </span>
   @endif

   <p class="font-weight-bold p-t-10" >Deskripsi Produk :</p>
   <p class="s-text85">
      @php echo $produk->keterangan @endphp
   </p>

<div class="p-t-33 p-b-60">
<div class="flex-r-m flex-w p-t-10 justify-content-center">
<div class="w-size18 flex-m flex-w">

   <div class="flex-w bo5 of-hidden bo-rad-23 m-r-22 m-t-10 m-b-10">
      <button class="btn-num-product-down  color1 flex-c-m size7 bg8 eff2">
         <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
      </button>

      <input class="size8 m-text18 t-center num-product" type="text" name="qty" value="1">

      <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
         <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
      </button>
   </div>

   <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10 mr-3">
      <button type='submit' value='submit' class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
         <span class="fa fa-plus"> Keranjang</span>
      </button>
   </div>

</div>
</div>
</div>
</form>  

</div>
</div>
</div>

<!-- promo dalam detail -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
<div class="container">

   <div class="sec-title p-b-60">
      <h3 class="m-text5 t-center">Promo Special</h3>
   </div>

<div class="wrap-slick2">
<div class="slick2">

@foreach($produk_promo as $produk_promo)
   <div class="item-slick2 p-l-15 p-r-15">

   <form action="/belanja" method='post'>
      @csrf
      <input type="hidden" name='id' value='{{$produk_promo->id_produk}}' >
      <input type="hidden" name='qty' value=1 >
      <input type="hidden" name='price' value='{{$produk_promo->harga_diskon}}'>
      <input type="hidden" name='name' value='{{$produk_promo->nama_produk}}'>
      <input type="hidden" name='redirect_page' value='{{url()->current()}}'>

      <div class="block2">
      <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
         <!-- gambar produk -->
         <img src="{{asset('assets/upload/image/'.$produk_promo->gambar)}}" alt="{{$produk_promo->nama_produk}}">
      <!-- overlay -->
      <div class="block2-overlay trans-0-4"> 
            <!-- add chart -->
            <div class="block2-btn-addcart w-size1 trans-0-4">
               <button type='submit' value='submit' class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                  <span class="fa fa-plus"> Keranjang</span>
               </button>
            </div>
      </div>
      </div>

         <div class="block2-txt p-t-20">
            <a href="/produk/detail/{{$produk_promo->slug_produk}}" class="block2-name dis-block s-text3 p-b-5">
               {{$produk_promo->nama_produk}}
            </a>
            
            <span class="block2-oldprice m-text7 p-r-5">
               IDR {{number_format($produk_promo->harga, '0', ',', '.')}}
            </span>
            <span class="block2-newprice m-text8 p-r-5">
               IDR {{number_format($produk_promo->harga_diskon, '0', ',', '.')}}
            </span>
         </div>

     </div>
 
   </form>
   </div>
@endforeach

</div>
</div>
</div>
</section>