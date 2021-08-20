<div class="content-wrapper">

<section class="content" >
<div class="container-fluid">
<div class="row">
<div class="col-12">

<div class="card mt-3">

<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >TAMBAH REKENING</h3>
</div>

<div class="card-body" >

<form action="/admin/rekening" method="post">
   @csrf
   <div class="form-group row" >
      <label  class="col-md-2 col-form-label">Nama Bank</label>
      <div class="col-md-5">
      <input type="text" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" placeholder="Nama Bank">
      @error('nama_bank')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Nomor Rekening</label>
      <div class="col-md-5">
      <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror" placeholder="Nomor Rekening" >
      @error('nomor_rekening')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Nama Pemilik Rekening</label>
      <div class="col-md-5">
      <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" placeholder="Nama Pemilik Rekening" >
      @error('nama_pemilik')
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

