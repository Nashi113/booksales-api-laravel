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
            <th>ID</th>
            <th>Nama Genre</th>
        </tr>
        @foreach($genres as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['name'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
