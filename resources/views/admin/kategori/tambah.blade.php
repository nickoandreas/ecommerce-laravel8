<div class="content-wrapper">

<section class="content mt-3" >
<div class="container-fluid">
<div class="row">
   <div class="col-12">
<div class="card ">
<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >INPUT KATEGORI PRODUK</h3>
</div>
<div class="card-body" >

<form action="/admin/kategori" method="post">
   @csrf
   <div class="form-group row" >
      <label  class="col-md-2 col-form-label">Nama Kategori</label>
      <div class="col-md-5">
      <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Nama Kategori">
      @error('nama_kategori')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

  
   <div class="form-group row">
      <label  class="col-md-2 control-label"></label>
      <div class="col-md-5">
      <button class="btn btn-info btn-sm  " name="submit" type="submit">
         <i class="fa fa-save"></i> Simpan
      </button>

      <button class="btn btn-danger btn-sm   " name="reset" type="reset">
         <i class="fa fa-times"></i> Reset
      </button>
   </div>

</form>

