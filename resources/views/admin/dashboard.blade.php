 @extends('admin._layouts.main')

 @section('content')
      <!-- Begin Page Content -->
 <div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12 mb-4">
        <div class="card p-4">
            Selamat Datang {{ Auth::guard('admin')->user()->name }}
        </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4" style="text-align: center">
        <h1>{{ $books_total }}</h1> 
        <p>Total Buku</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4" style="text-align: center">
          <h1>{{ $bookCategories_total }}</h1>
          <p>Total Kategori Buku</p>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
 @endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('template-admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('template-admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('template-admin/js/demo/chart-pie-demo.js') }}"></script>
@endsection