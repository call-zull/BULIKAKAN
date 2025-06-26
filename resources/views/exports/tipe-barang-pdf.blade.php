<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Jenis Barang</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Daftar Jenis Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $tipe)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tipe->nama }}</td>
                    <td>{{ $tipe->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
