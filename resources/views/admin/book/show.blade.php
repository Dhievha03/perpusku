@extends('admin._layouts.main')
@section('content')
     <!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
  <div class="card p-4 mb-4">
    <h5 class="font-weight-bold p-0 m-0">Detail Buku</h5>
  </div>

 <!-- Content Row -->
 <div class="row">
  <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
          <div class="card-body">
              <h5 class="font-weight-bold">{{ $book->book_title }}</h5>
              <p>{{ $book->user->name }} | {{ $book->created_at->diffForHumans() }} </p>
              <hr>
              <div class="d-flex justify-content-center mb-2">
                <img src="{{ asset('storage/cover/' . $book->cover_image) }}" alt="" srcset="" style="height: 400px; width: auto; max-width: 100%;">
              </div>
              <p>Kategori : {{ $book->categories->category_name }}</p>
              <p>Jumlah : {{ $book->amount }}</p>
              <div class="mt-4">
                {!! $book->description !!}
              </div>
          </div>
      </div>
  </div>

  <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
          <div class="card-body">
              <div class="pt-2 pb-2" style="overflow: hidden">
                
                <embed src="{{ asset('storage/book_file/' . $book->book_file) }}" type="application/pdf" width="100%" height="400px" />
              </div>
             
              <a href="{{ asset('storage/book_file/' . $book->book_file) }}" target="_blank" rel="noopener noreferrer">Lihat di tab baru</a>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection