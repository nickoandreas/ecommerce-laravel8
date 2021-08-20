<div class="content-wrapper">

<section class="content" >

<div class="flash-konfigurasi" 
   data-flashdata="">
</div>

<div class="container-fluid mt-2">
<div class="row">
   <div class="col-12">
<div class="card ">

<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >UPDATE LOGO WEBSITE</h3>
</div>

<div class="card-body" >

<form action="/admin/konfigurasi/logo/{{$konfigurasi->id_konfigurasi}}" method="post" enctype="multipart/form-data">
   @method('put')
   @csrf
   <div class="form-group  row" >
      <label  class="col-md-2 col-form-label">Nama Website</label>
      <div class="col-md-5">
      <input type="text" name="namaweb" class="form-control @error('namaweb') is-invalid @enderror" placeholder="Nama Website" value="{{$konfigurasi->namaweb}}">
      @error('namaweb')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group form row">
      <label  class="col-md-2 control-label">Ganti Logo Website</label>
      <div class="col-md-4">
      <img src="{{asset('assets/upload/image/thumbs/'.$konfigurasi->logo)}}" width="100" >
      <br><br>
      <input type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo" class="form-control" >
      @error('logo')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label"></label>
      <div class="col-md-5">
      <button class="btn btn-info btn-sm" name="submit" type="submit">
         <i class="fa fa-save"></i> Update
      </button>

      <button class="btn btn-danger btn-sm" name="reset" type="reset">
         <i class="fa fa-times"></i> Reset
      </button>
   </div>


</form>

