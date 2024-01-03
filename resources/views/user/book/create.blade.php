@extends('user._layouts.dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Tambah Wisata</h1>
 </div>

 <!-- Content Row -->
  <div class="card p-4 mb-4 col-lg-12">
    @if (session()->has('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
          {{ session()->get('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
    <form action="{{ route('user.book.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="form-group col-md-6 mb-4">
            <label>Judul Buku</label>
            <input type="text" class="form-control @error('book_title') is-invalid @enderror" name="book_title" value="{{ old('book_title') }}">
            @error('book_title')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
      
        <div class="form-group col-md-6 mb-4">
            <label>Kategori</label>
            <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror">
                <option value="" disabled selected>-- Pilih Kategori --</option>
                @foreach ($bookCategories as $item)
                    <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->category_name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group col-md-6 mb-4">
          <label>Jumlah</label>
          <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
          @error('amount')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>

        <div class="form-group col-md-6 mb-4">
          <label>File Buku</label>
          <input type="file" class="form-control @error('book_file') is-invalid @enderror form-control-file" id="pdfInput" name="book_file" value="{{ old('book_file') }}" accept=".pdf">
          @error('book_file')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>

        <div class="form-group col-md-6 mb-4">
          <label>Cover Buku</label>
          <input type="file" class="form-control @error('cover_image') is-invalid @enderror form-control-file" id="imageInput" onchange="previewImage()" name="cover_image" value="{{ old('cover_image') }}" accept=".png, .jpg, .jpeg">
          <img id="imagePreview" src="#" alt="Preview" class="mb-2 mt-2" style="display:none; width: 100%">
          @error('cover_image')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>

        <div class="form-group col-md-12 mb-4">
          <label>Deskripsi</label>
          <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description') }}</textarea>
           @error('description')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>

        <div class="col-12 row justify-content-end">
          <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </div>
    </form>
  </div>

@endsection

@section('script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description', {
        toolbar: [
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['Bold', 'Italic', 'Underline', 'Strike'],
            ['TextColor', 'BGColor'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Link', 'Unlink'],
            ['Undo', 'Redo'],
            ['Maximize'],
            '/',
        ]
    });
</script>

<script>
  function previewImage() {
      var input = document.getElementById('imageInput');
      var preview = document.getElementById('imagePreview');

      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              preview.src = e.target.result;
              preview.style.display = 'block';
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
@endsection