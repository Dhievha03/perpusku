<!DOCTYPE html>
<html>
<head>
	<title>Data Buku</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Data Buku</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
        <th>Cover</th>
				<th>Judul Buku</th>
        <th>Kategori</th>
				<th>Penulis</th>
				<th>Jumlah</th>
				<th>Deskripsi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($book as $item)
			<tr>
        <td><img src="{{ public_path('storage/cover/' . $item->cover_image) }}" style="width: 100px"></td>
				<td>{{$item->book_title}}</td>
				<td>{{$item->categories->category_name}}</td>
				<td>{{$item->user->name}}</td>
				<td>{{$item->amount}}</td>
        <td>{!! $item->description !!}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>