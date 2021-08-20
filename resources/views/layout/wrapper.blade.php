@php
use Illuminate\Support\Facades\DB;
$keranjang_nav = DB::table('keranjang')->where('id_pelanggan', session('id_pelanggan'))->get();
$total_belanja = DB::table('keranjang')->where('id_pelanggan', session('id_pelanggan'))->sum('subtotal');
@endphp
@include('layout.head')
@include('layout.header')
@include('layout.nav')
@include('layout.content')
@include('layout.footer')