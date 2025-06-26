<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Penemuan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px;
            vertical-align: middle;
            text-align: center;
        }
        img {
            height: 80px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Data Penemuan</h2>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Tempat</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Kontak</th>
                <th>Pelapor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>
                        @if($item->foto_barang && file_exists(public_path('storage/' . $item->foto_barang)))
                            <img src="{{ public_path('storage/' . $item->foto_barang) }}" alt="foto">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu)->format('Y-m-d H:i') }}</td>
                    <td>{{ $item->tempat }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->kontak }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
