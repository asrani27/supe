<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Nilai Akhir</th>
            <th>UUID</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            ?>
        @foreach($detail as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['nim'] }}</td>
                <td>{{ $item['nama_mahasiswa'] }}</td>
                <td>{{ $item['nilai_angka'] }}</td>
                <td>{{ $item['id_kelas_kuliah'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>