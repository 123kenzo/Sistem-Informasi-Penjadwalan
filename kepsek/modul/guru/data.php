<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header table-bordered">
          <div class="card-title" style="text-align: center; font-weight: bold;">
            DATA GURU SDN 11 SANGKU
          </div>
          <p class="card-title" style="text-align: center; font-weight: bold;">
            TAHUN AJARAN 2023/2024
          </p>
        </div>
        <div class="card-body table-bordered">
          <div class="table-responsive">
            <table id="basic-datatables" class="table align-items-center table-flush" >
              <thead class="text-center text-white bg-primary">
                <tr>
                  <th>No</th>
                  <th>Nip</th>
                  <th>Nama Guru</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                  <th>Foto</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $guru = mysqli_query($con, "SELECT * FROM tb_guru");
                foreach ($guru as $g) { ?>
                  <tr class="text-center">
                    <td>
                      <?= $no++; ?>.
                    </td>
                    <td>
                      <?= $g['nip']; ?>
                    </td>
                    <td>
                      <?= $g['nama_guru']; ?>
                    </td>
                    <td>
                      <?= $g['alamat']; ?>
                    </td>
                    <td>
                      <?= $g['jenis_kelamin']; ?>
                    </td>
                    <td>
                      <?= $g['jabatan']; ?>
                    </td>
                    <td>
                      <?php if ($g['status'] == 'Y') {
                        echo "<span class='badge badge-success'>Aktif</span>";
                      } else {
                        echo "<span class='badge badge-danger'>Off</span>";
                      } ?>
                    </td>
                    <td><img src="../assets/img/user/<?= $g['foto'] ?>" width="45" height="45"></td>
                    <td>
                      <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')"
                        href="?page=guru&act=del&id=<?= $g['id_guru'] ?>"><i class="fas fa-trash"></i>
                      </a>

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
</div>