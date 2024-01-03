@extends('admin._layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('template-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kategori Buku</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible col-lg-12" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible col-lg-12" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 mb-4">
                    @if (Route::is('admin.bookCategories.index'))
                    <form action="{{ route('admin.bookCategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" class="form-control" name="category_name" required placeholder="Nama Kategori">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    @elseif(Route::is('admin.bookCategories.edit'))
                    <form action="{{ route('admin.bookCategories.update', $bookCategory->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group mb-4">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" class="form-control" name="category_name" required placeholder="Nama Kategori" value="{{ $bookCategory->category_name }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    @endif
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card p-4 mb-4">
                    <div class="table-responsive mt-4">
                        <table class="table" id="data-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
<script src="{{ asset('template-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
  var dataTable = $('#data-table').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: true,
      scrollX: true,
      ajax: "{{ route('admin.bookCategories.getBookCategories') }}",
      columns: [
        {
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'category_name',
            name: 'category_name',
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
      ],
      language: {
          emptyTable: 'Tidak ada data dalam table',
          lengthMenu: 'Tampilkan _MENU_ entri',
          search: 'Pencarian:',
          info: 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri',
          infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
          paginate: {
              previous: '<i class="bx bx-chevron-left"></i>',
              next: "<i class='bx bx-chevron-right'></i>",
          }
      },
  });
</script>

@endsection
