<div class="content-wrapper">
   
<section class="content" >
<div class="container-fluid">
<div class="row">
<div class="col-12">

<div class="card card-dark mt-3">
<div class="card-header">
   <h3 class="card-title font-weight-bold" >UPDATE REKENING</h3>
</div>
<div class="card-body" >

<form action="/admin/rekening/edit/{{$rekening->id_rekening}}" method="post">
   @method('put')
   @csrf
   <div class="form-group row" >
      <label  class="col-md-2 col-form-label">Nama Bank</label>
      <div class="col-md-5"> 
      <input type="text" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" placeholder="Nama Bank" value="{{$rekening->nama_bank}}">
      @error('nama_bank')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">No Rekening</label>
      <div class="col-md-5">
      <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror" placeholder="Nomor Rekening"  value="{{$rekening->nomor_rekening}}" >
      @error('nomor_rekening')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>
   
   <div class="form-group row">
      <label  class="col-md-2 control-label">Nama Pemilik Rekening</label>
      <div class="col-md-5">
      <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" placeholder="Nama Pemilik Rekening"  value="{{$rekening->nama_pemilik}}" >
      @error('nama_pemilik')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row ">
      <label  class="col-md-2 control-label"></label>
      <div class="col-md-5 ">
      <button class="btn btn-info btn-sm" name="submit" type="submit">
         <i class="fa fa-save"></i> Update
      </button>

      <button class="btn btn-danger btn-sm" name="reset" type="reset">
         <i class="fa fa-times"></i> Reset
      </button>
   </div>

</form>

