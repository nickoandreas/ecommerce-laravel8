@php
session_start();
if(request()->session()->get('username') == NULL) {
  $_SESSION['flash'] = 'Anda Tidak Mempunyai Hak Akses';
  header('location: /admin/login', true, 301);
  exit();
  
}
@endphp
@include('admin.layout.head')
@include('admin.layout.header')
@include('admin.layout.nav')
@include('admin.layout.content')
@include('admin.layout.footer')