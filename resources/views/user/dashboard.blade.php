@extends('user._layouts.dashboard')

@section('content')
     <!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
 </div>

 <!-- Content Row -->
 <div class="row">

     <div class="col-12">
      <div class="card p-4">
        Selamat Datang {{ Auth::user()->name }}
      </div>
     </div>
 </div>

</div>
<!-- /.container-fluid -->
@endsection
