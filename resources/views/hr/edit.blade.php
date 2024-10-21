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

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="update-hr-form" enctype="multipart/form-data">
                            <input type="hidden" id="hr-id" value="{{ $hr->id }}">

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control" id="nama" value="{{ old('nama', $hr->nama) }}" placeholder="Masukkan Nama" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TANGGAL LAHIR</label>
                                <input type="date" class="form-control" id="tgl_lahir" value="{{ old('tgl_lahir', $hr->tgl_lahir) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">GAJI</label>
                                <input type="number" class="form-control" id="gaji" value="{{ old('gaji', $hr->gaji) }}" placeholder="Masukkan Gaji" required>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <a href="http://127.0.0.1:8000/hr" class="ml-3 btn btn-md btn-secondary">BACK</a>
                        </form>

                        <div id="alert-container"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('update-hr-form').addEventListener('submit', function (e) {
            e.preventDefault();
            
            const id = document.getElementById('hr-id').value;

            console.log(id)
            const nama = document.getElementById('nama').value;
            const tgl_lahir = document.getElementById('tgl_lahir').value;
            const gaji = document.getElementById('gaji').value;

            axios.put(`http://localhost:8000/api/hr/${id}`, {
                nama: nama,
                tgl_lahir: tgl_lahir,
                gaji: gaji
            })
            .then(response => {
                const alertContainer = document.getElementById('alert-container');
                alertContainer.innerHTML = `
                    <div class="alert alert-success mt-3">
                        ${response.data.message}
                    </div>
                `;
            })
            .catch(error => {
                const alertContainer = document.getElementById('alert-container');
                alertContainer.innerHTML = `
                    <div class="alert alert-danger mt-3">
                        Terjadi kesalahan: ${error.response.data.message || 'Gagal mengupdate data.'}
                    </div>
                `;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
