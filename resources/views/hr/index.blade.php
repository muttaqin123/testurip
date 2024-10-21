<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('hr.create') }}" class="btn btn-md btn-success mb-3">ADD DATA</a>
                        <a href="{{ route('hr.pdf') }}" class="btn btn-md btn-primary mb-3 ml-3">PRINT LAPORAN DATA</a>
                        <table class="table table-bordered" id="hr-table">
                            <thead>
                                <tr>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">TANGGAL LAHIR</th>
                                    <th scope="col">GAJI</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody id="hr-data">
                                <tr>
                                    <td colspan="4" class="text-center">Loading data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        axios.get('http://127.0.0.1:8000/api/hr')
            .then(response => {
                const hrData = response.data.data.data;
                let hrRows = '';

                if (hrData.length > 0) {
                    hrData.forEach(hr => {
                        hrRows += `
                        <tr>
                            <td>${hr.nama}</td>
                            <td>${hr.tgl_lahir}</td>
                            <td>Rp ${parseFloat(hr.gaji).toLocaleString('id-ID')}</td>
                            <td class="text-center">
                                <a href="/hr/${hr.id}/edit" class="btn btn-sm btn-primary">EDIT</a>
                                <button onclick="deleteHr(${hr.id})" class="btn btn-sm btn-danger">HAPUS</button>
                            </td>
                        </tr>
                    `;
                    });
                } else {
                    hrRows = '<tr><td colspan="4" class="text-center">Data hrs belum tersedia.</td></tr>';
                }

                document.getElementById('hr-data').innerHTML = hrRows;
            })
            .catch(error => {
                console.error("There was an error fetching the data!", error);
                document.getElementById('hr-data').innerHTML =
                    '<tr><td colspan="4" class="text-center">Gagal mengambil data.</td></tr>';
            });

        function deleteHr(id) {
            console.log(id);
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                axios.delete(`http://127.0.0.1:8000/api/hr/${id}`)
                    .then(response => {
                        alert('Data berhasil dihapus!');
                        location.reload();
                    })
                    .catch(error => {
                        alert('Gagal menghapus data!');
                    });
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>

</html>
