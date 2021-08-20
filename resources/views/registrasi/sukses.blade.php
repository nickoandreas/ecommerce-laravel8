<section class="bgwhite p-t-70 p-b-100">
<div class="container">

<div class="pos-relative">
<div class="bgwhite">

<h1 align='center'><b>{{$title}}</b></h1><hr>
<div class='clearfix'></div>
<br><br>

@if(session('sukses_registrasi'))
   <div class='alert alert-info ' align='center'> 
      {{session('sukses_registrasi')}}
   </div>
@endif

<p class='alert alert-success' align='center'>Registrasi Berhasil, Silahkan  <a href="/login" class='btn btn-info btn-sm'>Masuk Disini</a></p>


</div>
<!-- /wrap table -->
</div>
<!-- /container table -->
</div>
<!-- /container -->
</section>