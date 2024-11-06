<?php
$taAktif = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_thajaran WHERE status=1 "));
$semAktif = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_semester WHERE status=1 "));
?>
<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body table-bordered">
          <div class="table-responsive">
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
                  <th>No.</th>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Nama Guru</th>
                  <th>Mata Pelajaran</th>
                  <th>Kelas</th>
                  <th>TP/Semester</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $mengajar = mysqli_query($con, "SELECT * FROM tb_mengajar 
                            INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
                            INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
                            INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
                            INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
                            INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran 
                               ");
                foreach ($mengajar as $d) {
                ?>
                  <tr class="text-center">
                    <th scope="row"><b>
                        <?= $no++; ?>.
                      </b></th>
                    <td>
                      <?= $d['hari']; ?>
                    </td>
                    <td>
                      <?= $d['jam_mengajar']; ?>
                    </td>
                    <td>
                      <?= $d['nama_guru'] ?>
                    </td>
                    <td>
                      <?= $d['mapel'] ?>
                    </td>
                    <td>
                      <?= $d['nama_kelas'] ?>
                    </td>
                    <td>
                      <?= $d['tahun_ajaran'] ?>/
                      <?= $d['semester'] ?>
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
<script type="text/javascript">
  function showConfirmationModal(idMengajar) {
    Swal.fire({
      title: 'Konfirmasi Hapus Data',
      text: 'Apakah Anda yakin ingin menghapus data?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn btn-danger',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonClass: 'btn btn-secondary',
      cancelButtonText: 'Batal',
      reverseButtons: true
    }).then(function(result) {
      if (result.isConfirmed) {
        window.location.href = `?page=jadwal&act=cancel&id=${idMengajar}`;
      }
    });
  }
</script>
<div class="modal fade" id="buatjdwModal" tabindex="-2" role="dialog" aria-labelledby="buatjdwModalLabel" aria-hidden="true">
  <style>
    .modal-dialog {
      max-width: 100%;
    }

    .modal-lg {
      width: 75%;
    }
  </style>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h5 class="modal-title" id="buatjdwModalLabel" style="margin-left: 50%; 
                transform: translateX(-50%); font-weight: bold; display: inline-block;">BUAT JADWAL</h5>
        <!-- <h2 class="m-0 font-weight-bold text-primary">GENERATE JADWAL</h2> -->
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="kode">Kode Pelajaran</label>
                <input name="kode" type="text" class="form-control" id="kode" value="MPL-<?= time(); ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tahun Pelajaran</label>
                <input type="hidden" name="ta" value="<?= $taAktif['id_thajaran'] ?>">
                <input type="hidden" name="semester" value="<?= $semAktif['id_semester'] ?>">
                <input type="text" class="form-control" placeholder="<?= $taAktif['tahun_ajaran'] ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="kode">Semester</label>
                <input type="text" class="form-control" placeholder="<?= $semAktif['semester'] ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Guru Mata Pelajaran</label>
                <select name="guru" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php
                  $guru = mysqli_query($con, "SELECT * FROM tb_guru ORDER BY id_guru ASC");
                  foreach ($guru as $g) {
                    echo "<option value='$g[id_guru]'>$g[nama_guru]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Mata Pelajaran</label>
                <select name="mapel" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php
                  $mapel = mysqli_query($con, "SELECT * FROM tb_master_mapel ORDER BY id_mapel ASC");
                  foreach ($mapel as $g) {
                    echo "<option value='$g[id_mapel]'>[ $g[kode_mapel] ] $g[mapel]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
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
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Kelas</label>
                <select name="kelas" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php
                  $kelas = mysqli_query($con, "SELECT * FROM tb_mkelas ORDER BY id_mkelas ASC");
                  foreach ($kelas as $g) {
                    echo "<option value='$g[id_mkelas]'>$g[nama_kelas]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input name="waktu" type="text" class="form-control" id="waktu" placeholder="00.00-00.00">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="jamke">Jam Ke</label>
                <input name="jamke" type="text" class="form-control" id="jamke" placeholder="1 - 10">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button name="savejdw" type="submit" class="btn btn-secondary"><i class="far fa-save"></i> Simpan</button>
          </div>
        </form>
        <?php
        if (isset($_POST['savejdw'])) {
          $kode = $_POST['kode'];
          $ta = $_POST['ta'];
          $semester = $_POST['semester'];
          $guru = $_POST['guru'];
          $mapel = $_POST['mapel'];
          $hari = $_POST['hari'];
          $kelas = $_POST['kelas'];
          $waktu = $_POST['waktu'];
          $jamke = $_POST['jamke'];

          $insert = mysqli_query($con, "INSERT INTO tb_mengajar VALUES (NULL,'$kode','$hari','$waktu','$jamke','$guru','$mapel','$kelas','$semester','$ta' ) ");

          if ($insert) {
            echo "
            <script>
                          Swal.fire({
                              icon: 'success',
                              title: 'Sukses',
                              text: 'Data berhasil ditambahkan!',
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  window.location = '?page=jadwal';
                              }
                          });
                      </script>";
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cekjdwModal" tabindex="-2" role="dialog" aria-labelledby="cekModalLabel" aria-hidden="true">
  <style>
    .modal-dialog {
      max-width: 100%;
    }

    .modal-lg {
      width: 75%;
    }
  </style>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h2 class="modal-title" id="cekjdwModal" style="margin-left: 50%;
        transform: translateX(-50%); font-weight: bold; display: inline-block; color:blue;">CEK JADWAL BENTROK</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body table-bordered">
          <div class="table-responsive">
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
                  <th>No.</th>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Nama Guru</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 1;
                $mengajar = mysqli_query($con, "SELECT tb_mengajar.*, tb_guru.nama_guru FROM tb_mengajar 
                            INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
                            INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
                            INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
                            INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
                            INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran 
                            ");

                foreach ($mengajar as $d) {
                  $currentId = $d['id_mengajar'];
                  $currentJamMengajar = $d['jam_mengajar'];
                  $currentHari = $d['hari'];
                  $currentIdGuru = $d['id_guru'];

                  $queryBentrok = mysqli_query($con, "SELECT tb_mengajar.*, tb_guru.nama_guru FROM tb_mengajar 
                                    INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
                                    WHERE tb_mengajar.id_mengajar != $currentId 
                                    AND tb_mengajar.jam_mengajar = '$currentJamMengajar' 
                                    AND tb_mengajar.hari = '$currentHari' 
                                    AND tb_mengajar.id_guru = $currentIdGuru");

                  if (mysqli_num_rows($queryBentrok) > 0) {
                    $bentrokData = mysqli_fetch_assoc($queryBentrok);
                ?>
                    <tr>
                      <td><?= $counter++; ?></td>
                      <td><?= $bentrokData['hari']; ?></td>
                      <td><?= $bentrokData['jam_mengajar']; ?></td>
                      <td><?= $bentrokData['nama_guru']; ?></td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>

                    <!-- <script type='text/javascript'>
                      Swal.fire({
                        title: 'Jadwal Bentrok!',
                        text: 'Jadwal bentrok ditemukan pada hari <?= $currentHari; ?>, jam <?= $currentJamMengajar; ?> dengan guru yang sama.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                      });
                    </script> -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>