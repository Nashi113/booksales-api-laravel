<!DOCTYPE html>
<html>
<head>
    <title>Data Author</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Daftar Penulis Buku</h1>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama Penulis</th>
            <th>Negara</th>
        </tr>
        @foreach($authors as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['negara'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
