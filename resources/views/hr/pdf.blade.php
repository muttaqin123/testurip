<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Times New Roman', serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin-top: 0px;
            margin-bottom: 0px;
        }
    </style>
</head>

<body>
    <div>
        <p>LAPORAN PEGAWAI</p>
        <table>
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>TANGGAL LAHIR</th>
                    <th>GAJI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hr as $pegawai)
                    <tr>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->tgl_lahir }}</td>
                        <td>{{ $pegawai->gaji }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
