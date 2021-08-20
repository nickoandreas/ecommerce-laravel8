<div class="container ">

@if(session('warning'))
  <div class="alert alert-danger mt-3">{{session('warning')}}</div>
@endif

<p class='alert alert-success mt-3'>
   Belum Memiliki Akun ? Silakan 
   <a href="/registrasi" class='btn btn-info btn-sm'>Regsitrasi Disini</a>
</p>

<div class="card bg-light mt-3 mb-3">

   <div class="card-header">
      <h3 class="font-weight-bold">{{strtoupper($title)}}</h3>
   </div>

<div class="card-body">
<form action="/login" method='post'>
   @csrf
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="nama@domain.com">
    @error('email')
      <div class="invalid-feedback">{{$message}}</div>
   @enderror
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
    @error("password")
      <div class="invalid-feedback">{{$message}}</div>
    @enderror
  </div>

  <button type="submit" class="btn btn-dark hov1 bo-rad-20 p-l-25 p-r-25 ">MASUK</button>
  <button type="reset" class="btn btn-dark hov1 bo-rad-20 p-l-25 p-r-25 ">HAPUS</button>
</form>
</div>


</div>
</div>