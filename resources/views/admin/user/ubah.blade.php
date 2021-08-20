<div class="content-wrapper">

<section class="content" >
<div class="container-fluid mt-2">
<div class="row">
   <div class="col-12">
<div class="card ">
<div class="card-header bg-dark">
   <h3 class="card-title font-weight-bold" >UPDATE DATA</h3>
</div>
<div class="card-body" >

<form action="/admin/user/{{$user->id_user}}" method="post">
   @method('put')
   @csrf
   <div class="form-group row" >
      <label  class="col-md-2 col-form-label">Nama Pengguna</label>
      <div class="col-md-5">
      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Pengguna" value="{{$user->nama}}">
      @error('nama')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>

   <div class="form-group row">
      <label  class="col-md-2 control-label">Email Pengguna</label>
      <div class="col-md-5">
      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror " placeholder="Email Pengguna"  value="{{$user->email}}" >
      @error('email')
         <div class="invalid-feedback">{{$message}}</div>
      @enderror
      </div>
   </div>
   

   <div class="form-group row">
      <label  class="col-md-2 control-label">Level Hak Akses</label>
      <div class="col-md-5">
       <select name="akses_level" class="form-control">
         @foreach($level as $level)
            @if($level == $user->akses_level)

                  <option value="{{$user->akses_level}}" selected>{{$user->akses_level}}</option>

            @else

               <option value="{{$level}}">{{$level}}</option>

            @endif

         @endforeach
         </select>
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

