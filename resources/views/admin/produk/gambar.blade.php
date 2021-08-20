<div class="content-wrapper">
   <div class="flash-gambar" 
      data-flashdata="{{session('flash')}}">
   </div>
<section class="content" >
<div class="container-fluid mt-2">
<div class="row">
<div class="col-12">

<div class="card ">
<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >TAMBAH GAMBAR PRODUK</h3>
</div>

<div class="card-body" >

<form action="/admin/produk/gambar" method="POST" enctype="multipart/form-data">
   @csrf
   <input type="hidden" name="id_produk" value="{{$produk->id_produk}}">

   <div class="form-group  row" >
      <label  class="col-md-3 col-form-label">Judul Gambar Produk</label>
      <div class="col-md-5">
      <input type="text" name="judul_gambar" class="form-control @error('judul_gambar') is-invalid @enderror" placeholder="Judul Gambar">
      @error('judul_gambar')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group form row">
      <label  class="col-md-3 control-label">Upload Gambar Produk</label>
      <div class="col-md-3">
      <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar">
      @error('gambar')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-3 control-label"></label>
      <div class="col-md-3 ">
         <button class="btn btn-info btn-sm" name="submit" type="submit">
            <i class="fa fa-save"></i> Upload Gambar
         </button>

         <button class="btn btn-danger btn-sm" name="reset" type="reset">
            <i class="fa fa-times"></i> Reset
         </button>

      </div>
   </div>
</form>

<table id="example1" class="table table-bordered table-striped" >

<thead class="bg-secondary" >
   <tr >
      <th class="text-center">NO</th>
      <th class="text-center">ACTION</th>
      <th class="text-center">GAMBAR</th>
      <th>JUDUL</th>
   </tr>
</thead>

<tbody class="bg-dark">

   <tr>
      <td style="vertical-align:middle;" class="text-center">1</td>
      <td rowspan=1 ></td>
      <td align="center" style="vertical-align:middle;">
            <img src="{{asset('assets/upload/image/thumbs/'.$produk->gambar)}}" class="img img-responsive img-thumbnail "  style="width:60px;height:55px;" >
      </td>
      <td style="vertical-align:middle;" >{{$produk->nama_produk}}</td>
   </tr>

   @foreach($dataGambar as $dataGambar)
   <tr>
      <td style="vertical-align:middle;" class="text-center">{{$loop->iteration + 1}}</td>
      <td class="text-center" style="vertical-align:middle;" >
            <a href="/admin/produk/gambar/delete/{{$dataGambar->id_gambar}}" class="badge  bg-danger tombolHapus" ><i class="fa fa-trash "></i> Hapus</a>
      </td>
      <td align="center" style="vertical-align:middle;">
            <img src="{{asset('assets/upload/image/thumbs/'.$dataGambar->gambar)}}" class="img img-responsive img-thumbnail "  style="width:60px;height:55px;" >
      </td>
      <td style="vertical-align:middle;" >{{$dataGambar->judul_gambar}}</td>
   </tr>
   @endforeach
</tbody>

</table>

</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->