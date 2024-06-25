<!-- resources/views/client/data_penumpang.blade.php -->

<h1>Data Penumpang</h1>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penumpangs as $penumpang)
            <tr>
                <td>{{ $penumpang->nama }}</td>
                <td>{{ $penumpang->no_telp }}</td>
                <td>{{ $penumpang->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
