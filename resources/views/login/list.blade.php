<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{asset('assets/upload/image/'.$data['konfigurasi']->icon)}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
</head>
<body class="hold-transition login-page bg">
<div class="login-box">
<div class="login-logo">
    <img src="{{asset('assets/upload/image/'.$data['konfigurasi']->logo)}}"  
           class="brand-image img-circle elevation-3"
           style="opacity: .8" alt="SAS" width="180">
</div>
  <!-- /.login-logo -->
<div class="card shadow">

<div class="card-body login-card-body">
    <h6 class="login-box-msg font-weight-bold">LOGIN ADMINISTRATOR</h6>

@if ($errors->any())
   @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{$error}}</div>
   @endforeach
@endif

@php
  session_start();
  if(isset($_SESSION['flash'])) {
    echo '<div class="alert alert-danger">'.$_SESSION['flash'].'</div>';
  }
  unset($_SESSION['flash']);
@endphp

@if(session('warning'))
   <div class="alert alert-danger">{{session('warning')}}</div>
@endif

@if(session('sukses'))
   <div class="alert alert-warning">{{session('sukses')}}</div>
@endif


        <form action="/admin/login" method="POST">
         @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span> 
            </div>
          </div>
        </div>

        <!-- /.col -->
        <div class="col">
          <button type="submit" class="btn btn-info btn-block font-weight-bold shadow ">MASUK</button>
        </div>
          <!-- /.col -->
        </div>
     
        </form>

    </div>
    <!-- /.login-card-body -->
  </div>
  <!-- /card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/adminlte/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
