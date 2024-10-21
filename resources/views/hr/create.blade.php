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
                        <form id="create-hr-form" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TANGGAL LAHIR</label>
                                <input type="date" class="form-control" name="tgl_lahir" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">GAJI</label>
                                <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji" required>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <a href="http://127.0.0.1:8000/hr" class="ml-3 btn btn-md btn-secondary">BACK</a>
                        </form>

                        <div id="alert-container"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('create-hr-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            axios.post('http://localhost:8000/api/hr', {
                nama: formData.get('nama'),
                tgl_lahir: formData.get('tgl_lahir'),
                gaji: formData.get('gaji')
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
                        Terjadi kesalahan: ${error.response.data.message || 'Gagal menyimpan data.'}
                    </div>
                `;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
