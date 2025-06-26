<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Data Kehilangan</h2>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Tempat</th>
                <th>Waktu</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Kontak</th>
                <th>Tipe Barang</th>
                <th>Pelapor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>
                        @if($item->foto_barang)
                            <img src="{{ public_path('storage/' . $item->foto_barang) }}" width="60" />
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tempat }}</td>
                    <td>{{ optional($item->waktu)->format('Y-m-d H:i') }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->kontak }}</td>
                    <td>{{ $item->tipeBarang->nama ?? '-' }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>