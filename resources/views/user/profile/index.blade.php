@extends('user._layouts.dashboard')

@section('content')
     <!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
 <div class="card p-4 mb-4">
    <h5 class="font-weight-bold p-0 m-0">Profil Saya</h5>
 </div>

 <!-- Content Row -->
  <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data" class="row">
    @method('PUT')
    @csrf
    <div class="col-md-3 mb-4">
        <div class="card p-4">
            <div class="col-md-12">
                <div class="rounded-circle position-relative d-flex align-items-center justify-content-center" style="width: 100%; height: 0; padding-bottom: 100%; overflow: hidden; border: 2px solid #ebebeb">
                    <img id="profile-image" class="position-absolute w-100 h-100" src="{{ asset('storage/profile/' . Auth::user()->foto) }}" onerror="this.src='{{ asset('template-admin/img/undraw_profile.svg') }}';" style="top: 0" alt="Lingkaran dengan Background Image">
                </div>
                <label class="btn btn-primary w-100 mt-4" onclick="document.getElementById('upload-photo').click()">Ubah Foto</label>
                <input name="foto" type="file" id="upload-photo" class="d-none" accept="image/*"/>
                <small class="text-danger">Ukuran gambar maksimal 2MB</small>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card p-4">      
            <div class="row">
              <div class="form-group col-md-6 mb-4">
                <label>Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-group col-md-6 mb-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-group col-md-6 mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********">
                <small class="text-danger">*Abaikan jika tidak ingin mengubah password</small>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-group col-md-6 mb-4">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="********">
                <small class="text-danger">*Abaikan jika tidak ingin mengubah password</small>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">Update</button>
              </div>
            </div>
          
        </div>
    </div>
  </form>

</div>
<!-- /.container-fluid -->
@endsection

@section('script')
<script>
  document.getElementById('upload-photo').addEventListener('change', function () {
      var fileInput = this;
      var file = fileInput.files[0];

      if (file) {
          var reader = new FileReader();

          reader.onload = function (e) {
              document.getElementById('profile-image').src = e.target.result;
          };

          reader.readAsDataURL(file);
      }
  });
</script>
@endsection