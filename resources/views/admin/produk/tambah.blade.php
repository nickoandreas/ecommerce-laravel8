<div class="content-wrapper">

<section class="content" >
<div class="container-fluid mt-2">
<div class="row">
 <div class="col-12">

<div class="card ">

<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >INPUT DATA PRODUK</h3>
</div>

<div class="card-body" >

<form action="/admin/produk/tambah" method="post" enctype="multipart/form-data">
   @csrf
   <div class="form-group  row" >
      <label  class="col-md-2 col-form-label">Nama Produk</label>
      <div class="col-md-5">
      <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Nama Produk">
      @error('nama_produk')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Kode Produk</label>
      <div class="col-md-5">
      <input type="text" name="kode_produk" class="form-control @error('kode_produk') is-invalid @enderror" placeholder="Kode Produk">
      @error('kode_produk')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Kategori Produk</label>
      <div class="col-md-5">
         <select name="id_kategori" class="form-control">
            @foreach($kategori as $kategori)
               <option value="{{$kategori->id_kategori}}">{{$kategori->nama_kategori}}</option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Harga Produk</label>
      <div class="col-md-2">
         <input type="number" name="harga" class="form-control" placeholder="Harga Produk">
         <small class="text-success">Harga Jual</small>
      </div>

      <div class="col-md-2">
         <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli">
         <small class="text-success">Harga Beli</small>
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Harga Diskon Produk</label>
      <div class="col-md-2">
         <input type="number" name="harga_diskon" class="form-control" placeholder="Harga Diskon">
         <small class="text-success">Harga Diskon</small>
      </div>

      <div class="col-md-2 dates">
         <input type="text" name="tanggal_mulai_diskon" class="form-control datepicker" placeholder="dd-mm-yy" autocomplete="off">
         <small class="text-success">Tanggal Mulai Diskon</small>
      </div>
      
      <div class="col-md-2 dates">
         <input type="text" name="tanggal_akhir_diskon" class="form-control datepicker"  placeholder="dd-mm-yy" autocomplete="off">
         <small class="text-success">Tanggal Selesai Diskon</small>
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Stok Produk & Stok Minimal</label>
      <div class="col-md-2">
         <input type="number" name="stok" class="form-control" placeholder="Stok Produk">
         <small class="text-success">Jumlah Stok Produk</small>
      </div>

      <div class="col-md-2">
         <input type="number" name="stok_minimal" class="form-control" placeholder="Minimal Pemesanan">
         <small class="text-success">Minimal Pemesanan</small>
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Berat</label>
      <div class="col-md-5">
         <input type="text" name="berat" class="form-control" placeholder="Berat">
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Ukuran</label>
      <div class="col-md-5">
         <input type="text" name="ukuran" class="form-control" placeholder="Ukuran">
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Keterangan</label>
      <div class="col-md-8">
         <textarea name="keterangan" class="form-control" placeholder="Keterangan" id="editor"></textarea>
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Keyword</label>
      <div class="col-md-8">
         <textarea name="keywords" class="form-control" placeholder="Keyword" ></textarea>
      </div>
   </div>

   <div class="form-group form row">
      <label  class="col-md-2 control-label">Gambar Produk</label>
      <div class="col-md-4">
         <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar">
         @error('gambar')
            <div class="invalid-feedback">{{$message}}</div>
         @enderror
      </div>
   </div>

   <div class="form-group form row">
      <label  class="col-md-2 control-label">Status Produk</label>
      <div class="col-md-5">
         <select name="status_produk" class="form-control">
            <option value="Publish">Publikasikan</option>
            <option value="Draft">Simpan Sebagai Draft</option>
         </select>
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label"></label>
      <div class="col-md-5">
         <button class="btn btn-info btn-sm" name="submit" type="submit">
            <i class="fa fa-save"></i> Simpan
         </button>

         <button class="btn btn-danger btn-sm" name="reset" type="reset">
            <i class="fa fa-times"></i> Reset
         </button>
      </div>
   </div>

</form>

