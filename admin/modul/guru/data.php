<?php
$edit = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru='$_GET[id]' ");
foreach ($edit as $d) ?>
<div class="page-inner">
  <h3 class="m-0 font-weight-bold"><i class="fas fa-user-tie mr-2"></i>Data Guru SDN 11 Sangku 2023/2024</h3><br>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header table-bordered">
          <div class="card-title">
            <a href="#" class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus"></i> Tambah</a>
            <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#importModal"><i class="fa fa-upload mr-2"></i>Import</a>
          </div>
        </div>
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
            <table id="basic-datatables" class="display table table-bordered table-hover" cellspacing="0" width="100%">
              <thead class="text-center font-weight-bold">
                <tr>
                  <th style="width: 10px;">No</th>
                  <th>Foto</th>
                  <th>Nip</th>
                  <th>Nama Guru</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>
                  <th>Jabatan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $guru = mysqli_query($con, "SELECT * FROM tb_guru");
                foreach ($guru as $g) { ?>
                  <tr class="text-center">
                    <td class="text-center">
                      <?= $no++; ?>.
                    </td>
                    <td class="text-center">
                      <a href="../assets/img/user/<?= $g['foto'] ?>" data-lightbox="guru-photos" data-title="<?= $g['nama_guru'] ?>">
                        <img src="../assets/img/user/<?= $g['foto'] ?>" width="45" height="45" alt="<?= $g['nama_guru'] ?>">
                      </a>
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
                    <td class="text-center">
                      <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></a>
                      <a class="btn btn-danger btn-sm" href="#" onclick="confirmDelete(<?= $g['id_guru'] ?>)"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal fade" id="tambahModal" tabindex="-2" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title" id="tambahModalLabel" style="margin-left: 50%; transform: translateX(-50%); font-weight: bold; display: inline-block;">TAMBAH DATA GURU</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>NIP/NUPTK</label>
                        <input name="nip" type="text" class="form-control" placeholder="NIP/NUPTK" id="inputNIP">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Guru</label>
                        <input name="nama" type="text" class="form-control" placeholder="Nama dan Gelar">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" type="text" class="form-control" placeholder="Alamat"></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control">
                          <option value="">- Pilih -</option>
                          <option value="laki-laki">Laki-Laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jabatan</label>
                        <input name="jabatan" type="text" class="form-control" placeholder="Jabatan">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username">
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="text" class="form-control" placeholder="Password">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Foto</label>
                          <input type="file" name="foto">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button name="tambahData" type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
                <?php
                if (isset($_POST['tambahData'])) {

                  $pass = sha1($_POST['password']);

                  $sumber = @$_FILES['foto']['tmp_name'];
                  $target = '../assets/img/user/';
                  $nama_gambar = @$_FILES['foto']['name'];
                  $pindah = move_uploaded_file($sumber, $target . $nama_gambar);
                  if (!empty($pindah)) {
                    $save = mysqli_query($con, "INSERT INTO tb_guru VALUES(NULL,'$_POST[nip]','$_POST[nama]','$_POST[alamat]','$_POST[jk]','$_POST[jabatan]','$_POST[username]','$pass','$nama_gambar','Y') ");
                    if ($save) {
                      echo "
                      <script>
                          Swal.fire({
                              icon: 'success',
                              title: 'Sukses',
                              text: 'Data berhasil ditambahkan!',
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  window.location = '?page=guru';
                              }
                          });
                      </script>";
                    }
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title" id="importModalLabel" style="margin-left: 50%; transform: translateX(-50%); font-weight: bold; display: inline-block;">IMPORT DATA GURU</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Pilih file Excel (.xls, .xlsx):</label>
                    <input type="file" name="file" accept=".xls, .xlsx" required>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button name="importExcel" type="submit" class="btn btn-primary">Import Data</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-2" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title" id="editModalLabel" style="margin-left: 50%; transform: translateX(-50%); font-weight: bold; display: inline-block;">EDIT DATA GURU</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>NIP/NUPTK</label>
                        <input type="hidden" name="id" value="<?= $d['id_guru'] ?>">
                        <input name="nip" type="text" class="form-control" value="<?= $g['nip'] ?>" readonly>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Nama Guru</label>
                        <input name="nama" type="text" class="form-control" value="<?= $g['nama_guru'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" type="text" class="form-control" value="<?= $g['alamat'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input name="jk" type="text" class="form-control" value="<?= $g['jenis_kelamin'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Jabatan</label>
                        <input name="jabatan" type="text" class="form-control" value="<?= $g['jabatan'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p>
                          <img src="../assets/img/user/<?= $g['foto']; ?>" class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
                        </p>
                        <label>Foto</label>
                        <input type="file" name="foto">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <button name="editGuru" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Update</button>
                        <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                      </div>
                    </div>
                  </div>
                </form>
                <?php
                if (isset($_POST['editGuru'])) {

                  $pass = sha1($_POST['jabatan']);
                  $gambar = @$_FILES['foto']['name'];
                  if (!empty($gambar)) {
                    move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/user/$gambar");
                    $ganti = mysqli_query($con, "UPDATE tb_guru SET foto='$gambar' WHERE id_guru='$_POST[id]' ");
                  }
                  $editGuru = mysqli_query($con, "UPDATE tb_guru SET nama_guru='$_POST[nama]',alamat='$_POST[alamat]',jenis_kelamin='$_POST[jk]',jabatan='$_POST[jabatan]' WHERE id_guru='$_POST[id]' ");

                  if ($editGuru) {
                    echo "
				<script type='text/javascript'>
				setTimeout(function () { 

				swal('($_POST[nama]) ', 'Berhasil diubah', {
				icon : 'success',
				buttons: {        			
				confirm: {
				className : 'btn btn-success'
				}
				},
				});    
				},10);  
				window.setTimeout(function(){ 
				window.location.replace('?page=guru');
				} ,3000);   
				</script>";
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
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
                window.location = `?page=guru&act=del&id=${id}`;
              }
            });
          }
        </script>
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            var inputNIP = document.getElementById('inputNIP');
            inputNIP.addEventListener('input', function() {
              this.value = this.value.replace(/\D/g, '');
              if (!(/^\d+$/.test(this.value))) {
                Swal.fire({
                  icon: 'warning',
                  title: 'Peringatan',
                  text: 'Masukkan hanya angka untuk NIP/NUPTK',
                });
              }
            });
          });
        </script>

      </div>
    </div>
  </div>
</div>