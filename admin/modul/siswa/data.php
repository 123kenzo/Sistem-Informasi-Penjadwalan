<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Siswa</h4>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header table-bordered">
          <h3 class="h4">Daftar Siswa</h3>
        </div>
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
              /* Add padding for better appearance */
            }
          </style>
          <table id="basic-datatables" class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>NIS/NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tahun Masuk</th>
                <th>Status</th>
                <th>Foto</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $siswa = mysqli_query($con, "SELECT * FROM tb_siswa
                 INNER JOIN tb_mkelas ON tb_siswa.id_mkelas=tb_mkelas.id_mkelas
                 ORDER BY id_siswa ASC
                ");
              foreach ($siswa as $g) { ?>
                <tr class="text-center">
                  <td>
                    <?= $no++; ?>.
                  </td>
                  <td>
                    <?= $g['nis']; ?>
                  </td>
                  <td>
                    <?= $g['nama_siswa']; ?>
                  </td>
                  <td>
                    <?= $g['nama_kelas']; ?>
                  </td>
                  <td>
                    <?= $g['th_angkatan']; ?>
                  </td>
                  <td>
                    <?php if ($g['status'] == 1) {
                      echo "<span class='badge badge-success'>Aktif</span>";
                    } else {
                      echo "<span class='badge badge-danger'>Off</span>";
                    } ?>
                  </td>
                  <td><img src="../assets/img/user/<?= $g['foto'] ?>" width="45" height="45"></td>
                  <td>
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=siswa&act=del&id=<?= $g['id_siswa'] ?>"><i class="fas fa-trash"></i></a>
                    <a class="btn btn-info btn-sm" href="?page=siswa&act=edit&id=<?= $g['id_siswa'] ?>"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>