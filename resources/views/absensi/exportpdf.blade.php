<!DOCTYPE html>
<html>
<head>
	<title>Data Meal Attendance SKP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 10pt;
		}
	</style>
	<center>
		<h5>Data Meal Attendance SKP</h5>
	</center>
	<table class="table zero-configuration">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($absensi as $abs)
            <tr>
                <td>{{ $i++}}</td>
                <td>{{ $abs->karyawan->nama_lengkap() }}</td>
                <td>{{ $abs->status }}</td>
                <td>{{ $abs->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
	</table>
</body>
</html>