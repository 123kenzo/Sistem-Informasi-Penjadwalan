<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header table-bordered">
          <h2 class="m-0 font-weight-bold text-primary text-center">REQUEST JADWAL</h2>
        </div>
        <div class="card-body table-bordered">
          <form action="" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Guru</label>
                  <input name="nama" type="text" class="form-control" id="nama">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-check">
                  <label>Hari</label><br />
                  <label class="form-radio-label">
                    <input class="form-radio-input" type="radio" name="hari" value="Senin">
                    <span class="form-radio-sign">Senin</span>
                  </label>
                  <label class="form-radio-label">
                    <input class="form-radio-input" type="radio" name="hari" value="Selasa">
                    <span class="form-radio-sign">Selasa</span>
                  </label>
                  <label class="form-radio-label">
                    <input class="form-radio-input" type="radio" name="hari" value="Rabu">
                    <span class="form-radio-sign">Rabu</span>
                  </label>
                  <label class="form-radio-label">
                    <input class="form-radio-input" type="radio" name="hari" value="Kamis">
                    <span class="form-radio-sign">Kamis</span>
                  </label>
                  <label class="form-radio-label">
                    <input class="form-radio-input" type="radio" name="hari" value="Jumat">
                    <span class="form-radio-sign">Jumat</span>
                  </label>
                </div>
              </div>
            </div>
            <button type="submit" name="saveRjadwal" class="btn btn-secondary">
              <i class="far fa-save"></i> Simpan
            </button>
          </form>
          <?php
          if (isset($_POST['saveRjadwal'])) {
            $guru = $_POST['nama'];
            $hari = $_POST['hari'];

            $insert = mysqli_query($con, "INSERT INTO tb_rjadwal VALUES (NULL,'$guru','$hari')");

            echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Sukses",
                text: "Data berhasil disimpan.",
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "?page=requesjadwal";
                }
              });
            </script>';
          }
          ?>



        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body table-bordered">
          <style>
            #basic-datatables {
              border-collapse: collapse;
              width: 100%;
              border-spacing: 0;
            }

            #basic-datatables th,
            #basic-datatables td {
              border: 1pt solid black;
              padding: 8px;
            }
          </style>
          <table id="basic-datatables" class="table table-bordered">
            <thead class="bg-primary text-white text-center">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Hari</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $rjadwal = mysqli_query($con, "SELECT * FROM tb_rjadwal");
              foreach ($rjadwal as $g) { ?>
                <tr class="text-center">
                  <td>
                    <?= $no++; ?>.
                  </td>
                  <td>
                    <?= $g['nama_guru']; ?>
                  </td>
                  <td>
                    <?= $g['hari']; ?>
                  </td>
                  <td>
                    <a class="btn btn-danger btn-sm" href="#" onclick="confirmDelete(<?= $g['id_rjadwal'] ?>)"><i class="fas fa-trash"></i></a>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <script>
            function confirmDelete(id) {
              Swal.fire({
                title: 'Konfirmasi Hapus Data',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location = `?page=requesjadwal&act=del&id=${id}`;
                }
              });
            }
          </script>
        </div>
      </div>
    </div>
  </div>
</div>