<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->user->username }}</td>
                <td>{{ $row->buku->judul }}</td>
                <td>{{ $row->tanggal_peminjaman }}</td>
                <td>{{ $row->tanggal_pengembalian }}</td>
                <td>{{ $row->status_peminjaman }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
