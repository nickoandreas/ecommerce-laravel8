<?php

use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\User;
use App\Http\Controllers\admin\Konfigurasi;
use App\Http\Controllers\admin\Rekening;
use App\Http\Controllers\admin\Transaksi;
use App\Http\Controllers\admin\Kategori;
use App\Http\Controllers\admin\Produk;
use App\Http\Controllers\Login;
// pelanggan
use App\Http\Controllers\Home;
use App\Http\Controllers\Registrasi;
use App\Http\Controllers\Masuk;
use App\Http\Controllers\Produk_pelanggan;
use App\Http\Controllers\Belanja;
use App\Http\Controllers\Datakota;
use App\Http\Controllers\Dashboard_pelanggan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// home
Route::get('/', [Home::class, 'index']);
// registrasi pelanggan
Route::get('/registrasi', [Registrasi::class, 'index']);
Route::post('/registrasi', [Registrasi::class, 'registrasi']);
Route::get('/registrasi/sukses', [Registrasi::class, 'sukses']);
// login pelanggan
Route::get('/login', [Masuk::class, 'index']);
Route::post('/login', [Masuk::class, 'login']);
Route::get('/logout', [Masuk::class, 'logout']);
// Produk
Route::get('/produk', [Produk_pelanggan::class, 'index']);
Route::get('/produk/parts_motor', [Produk_pelanggan::class, 'parts_motor']);
Route::get('/produk/parts_mobil', [Produk_pelanggan::class, 'parts_mobil']);
Route::get('/produk/kategori2/{slug_kategori}', [Produk_pelanggan::class, 'kategori2']);
Route::get('/produk/kategori4/{slug_kategori}', [Produk_pelanggan::class, 'kategori4']);
Route::get('/produk/detail/{slug_produk}', [Produk_pelanggan::class, 'detail']);
// Keranjang Belanja
Route::get('/belanja', [Belanja::class, 'index']);
Route::post('/belanja', [Belanja::class, 'add']);
Route::get('/belanja/hapus/{rowid}', [Belanja::class, 'hapus']);
Route::put('/belanja/update/{rowid}', [Belanja::class, 'update']);
Route::get('/belanja/hapus', [Belanja::class, 'hapus_semua']);
Route::get('/belanja/checkout', [Belanja::class, 'hal_checkout']);
Route::post('/belanja/checkout', [Belanja::class, 'checkout']);
Route::get('/belanja/sukses', [Belanja::class, 'sukses']);
// Dashboard pelanggan
Route::get('/dashboard', [Dashboard_pelanggan::class, 'index']);
Route::post('/dashboard/konfirmasi/{kode_transaksi}', [Dashboard_pelanggan::class, 'konfirmasi']);
Route::get('/dashboard/belanja', [Dashboard_pelanggan::class, 'belanja']);
Route::get('/dashboard/detail/{kode_transaksi}', [Dashboard_pelanggan::class, 'detail']);
Route::get('/dashboard/profile', [Dashboard_pelanggan::class, 'profile']);
Route::put('/dashboard/profile', [Dashboard_pelanggan::class, 'update_profile']);
Route::get('/dashboard/batalkan/{kode_transaksi}', [Dashboard_pelanggan::class, 'batalkan']);
// api rajaongkir
Route::get('/datakota/kotaaja/{id_provinsi}', [Datakota::class, 'kotaaja']);
Route::get('/datakota/nama_kota/{id_kota}/{id_provinsi}', [Datakota::class, 'nama_kota']);
Route::get('/datakota/nama_provinsi/{id_kota}/{id_provinsi}', [Datakota::class, 'nama_provinsi']);
Route::get('/datakota/layanan/{origin}/{destination}/{weight}/{kurir}', [Datakota::class, 'layanan']);
Route::get('/datakota/kotaById/{id_provinsi}', [Datakota::class, 'kotaById']);
// autocomplete
Route::get('/produk/get_produk/{keyword}', [Produk_pelanggan::class, 'get_produk']);
// ====================ADMIN==============================
// login admin
Route::get('/admin/login', [Login::class, 'index']);
Route::post('/admin/login', [Login::class, 'login']);
Route::get('/admin/keluar', [Login::class, 'keluar']);
// home admin
Route::get('/admin/dashboard', [Dashboard::class, 'index']);
// user admin
Route::get('/admin/user', [User::class, 'index']); 
Route::get('/admin/user/tambah', [User::class, 'tambah']);
Route::post('/admin/user', [User::class, 'simpan']);
Route::get('/admin/user/ubah/{id_user}', [User::class, 'ubah']);
Route::put('/admin/user/{id_user}', [User::class, 'update']);
Route::get('/admin/user/delete/{id_user}', [User::class, 'hapus']);
// konfigurasi website 
Route::get('/admin/konfigurasi', [Konfigurasi::class, 'home']);
Route::put('/admin/konfigurasi/{id_konfigurasi}', [Konfigurasi::class, 'update']);
Route::get('/admin/konfigurasi/icon', [Konfigurasi::class, 'icon']);
Route::put('/admin/konfigurasi/icon/{id_konfigurasi}', [Konfigurasi::class, 'update_icon']);
Route::get('/admin/konfigurasi/logo/', [Konfigurasi::class, 'logo']);
Route::put('/admin/konfigurasi/logo/{id_konfigurasi}', [Konfigurasi::class, 'update_logo']);
// rekening 
Route::get('/admin/rekening', [Rekening::class, 'index']);
Route::get('/admin/rekening/tambah', [Rekening::class, 'tambah']);
Route::post('/admin/rekening', [Rekening::class, 'simpan']);
Route::get('/admin/rekening/delete/{id_rekening}', [Rekening::class, 'hapus']);
Route::get('/admin/rekening/edit/{id_rekening}', [Rekening::class, 'ubah']);
Route::put('/admin/rekening/edit/{id_rekening}', [Rekening::class, 'update']);
// transaksi
Route::get('/admin/transaksi', [Transaksi::class, 'index']);
Route::get('/admin/transaksi/packing', [Transaksi::class, 'packing']);
Route::get('/admin/transaksi/kirim', [Transaksi::class, 'kirim']);
Route::get('/admin/transaksi/diterima', [Transaksi::class, 'diterima']);
Route::get('/admin/transaksi/hapus/{kode_transaksi}', [Transaksi::class, 'delete']);
Route::get('/admin/transaksi/detail/{kode_transaksi}', [Transaksi::class, 'detail']);
Route::get('/admin/transaksi/detail_pdf/{kode_transaksi}', [Transaksi::class, 'detail_pdf']);
Route::get('/admin/transaksi/konfirmasi/{kode_transaksi}', [Transaksi::class, 'konfirmasi']);
Route::get('/admin/transaksi/pengiriman/{kode_transaksi}', [Transaksi::class, 'pengiriman']);
Route::put('/admin/transaksi/resi/{kode_transaksi}', [Transaksi::class, 'resi']);
Route::get('/admin/transaksi/invoice/{kode_transaksi}', [Transaksi::class, 'invoice']);
Route::get('/admin/transaksi/sampai/{kode_transaksi}', [Transaksi::class, 'pesanan_sampai']);
//kategori
Route::get('/admin/kategori', [Kategori::class, 'index']);
Route::get('/admin/kategori/tambah', [Kategori::class, 'tambah']);
Route::post('/admin/kategori', [Kategori::class, 'simpan']);
Route::get('/admin/kategori/delete/{id_kategori}', [Kategori::class, 'hapus']);
Route::get('/admin/kategori/edit/{id_katgori}', [Kategori::class, 'ubah']);
Route::put('/admin/kategori/edit/{id_katgori}', [Kategori::class, 'update']);
// produk
Route::get('/admin/produk', [Produk::class, 'index']);
Route::get('/admin/produk/tambah', [Produk::class, 'tambah']);
Route::post('/admin/produk/tambah', [Produk::class, 'simpan']);
Route::get('/admin/produk/edit/{id_produk}', [Produk::class, 'ubah']);
Route::put('/admin/produk/edit/{id_produk}', [Produk::class, 'update']);
Route::get('/admin/produk/delete/{id_produk}', [Produk::class, 'hapus']);
Route::get('/admin/produk/gambar/{id_produk}', [Produk::class, 'gambar']);
Route::post('/admin/produk/gambar', [Produk::class, 'simpan_gambar']);
Route::get('/admin/produk/gambar/delete/{id_gambar}', [Produk::class, 'hapus_gambar']);




