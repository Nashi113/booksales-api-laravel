<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookstore</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Beberapa buku favorit</h1><table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        @foreach($books as $item)
        <tr>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['price'] }}</td>
            <td>{{ $item['stock'] }}</td>
        </tr>   
        @endforeach
    </table>
</body>
</html>