<div class="container ">

@if(session('sukses_update'))
   <div class='alert alert-success mt-3' align='center'> 
      {{session('sukses_update')}}
   </div>
@endif

<div class="card bg-light mt-3 mb-3">

   <div class="card-header">
      <h3 class="font-weight-bold">{{$title}}</h3>
   </div>

<div class="card-body">
<form action="/dashboard/profile" method='post'>
   @method('put')
   @csrf
   <div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama" name="nama_pelanggan" placeholder="Nama Pengguna" value="{{$pelanggan->nama_pelanggan}}">
   @error('nama_pelanggan')
      <div class="invalid-feedback">{{$message}}</div>
   @enderror
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="nama@domain.com" value='{{$pelanggan->email}}'readonly>
  </div>

  <div class="form-group">
    <label for="telepon">No Telepon</label>
    <input type="telepon" class="form-control @error('telepon') is-invalid @enderror" name="telepon" id="telepon" placeholder="08xxxxxxxxxxx" value="{{$pelanggan->telepon}}">
    @error('telepon')
      <div class="invalid-feedback">{{$message}}</div>
   @enderror
  </div>

  <div class="row">
  <div class="col-6">
  <div class="form-group">
    <label for="provinsi">Provinsi</label>
    <select class="form-control profile-provinsi @error('id_provinsi') is-invalid @enderror" name="id_provinsi" id="provinsi">
   
      <option>--Pilih Provinsi--</option>
      @foreach($provinsi as $provinsi)
         @if($pelanggan->id_provinsi == $provinsi['province_id'])
         <option id_provinsi="{{$provinsi['province_id']}}" value="{{$provinsi['province_id']}}" selected> 
            {{$provinsi['province']}}
         </option>
        @else
         <option id_provinsi="{{$provinsi['province_id']}}" value="{{$provinsi['province_id']}}"> 
            {{$provinsi['province']}}
         </option>
        @endif
      @endforeach
   
    </select>
   @error('id_provinsi')
      <div class="invalid-feedback">{{$message}}</div>
   @enderror
  </div>
  </div>

  <div class="col-6">
  <div class="form-group">
    <label for="kota">Kabupaten/Kota</label>
    <select class="form-control profile-kota @error('id_kota') is-invalid @enderror" name="id_kota" id="kota">
      <option>--Pilih Kota--</option>
    </select>
   @error('id_kota')
      <div class="invalid-feedback">{{$message}}</div>
   @enderror
  </div>
  </div>
  </div>

  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea class="form-control @error('alamat') is-invalid @enderror" name='alamat' id="alamat" rows="3">{{$pelanggan->alamat}}</textarea>
    @error('alamat')
      <div class="invalid-feedback">{{$message}}</div>
   @enderror   
  </div>

  <button type="submit" class="btn btn-dark hov1 activebo-rad-20 p-l-25 p-r-25">UPDATE</button>
</form>
</div>

</div>
</div>