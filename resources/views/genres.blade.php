<!DOCTYPE html>
<html>
<head>
    <title>Data Genre</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Daftar Genre Buku</h1>
    <table border="1" cellpadding="8">
        <tr>
            <th>Genre</th>
            <th>Deskripsi</th>
        </tr>
        @foreach($genres as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['description'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
