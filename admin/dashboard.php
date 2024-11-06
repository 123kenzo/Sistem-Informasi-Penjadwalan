<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
?>
    <script>
        alert('Maaf! Anda Belum Login!!');
        window.location = 'index.php';
    </script>
<?php
    exit; 
}

$jumlahsiswa = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_siswa WHERE status='1'"));
$jumlahGuru = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_guru WHERE status='Y'"));

$id_login = $_SESSION['admin'];

$sql = mysqli_query($con, "SELECT * FROM tb_admin WHERE id_admin = '$id_login'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);

if (!$data) {
    echo "Data not found!";
    exit; 
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Administrator | SDN 11 SANGKU</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" type="image/png" href="../assets/img/logo-sd.png" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</head>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="navbar logo-header bg-dark">
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<style>
				.rotate-icon {
					animation: rotate 2s infinite linear;
				}

				@keyframes rotate {
					from {
						transform: rotate(0deg);
					}

					to {
						transform: rotate(360deg);
					}
				}
			</style>

			<nav class="navbar navbar-header navbar-expand-lg bg-dark2">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<i class="fas fa-cog settings-icon rotate-icon" style="font-size: 35px;" class="avatar-img rounded-circle"></i>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="u-text">
												<h4>
													<?= $data['nama_guru'] ?>
												</h4>
												<p class="text-muted">
													<?= $data['email'] ?>
												</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#gantiPassword" class="collapsed">Ganti Password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#pengaturanAkun" class="collapsed">Atur akun</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item" data-toggle="modal" onclick="confirmLogout()">Keluar</a>
									<li class="nav-item active mt-3"></li>
						</li>
				</div>
				</ul>
				</li>
				</ul>
		</div>
		</nav>
	</div>

	<div class="sidebar sidebar-style-2">
		<div class="sidebar-wrapper scrollbar scrollbar-inner bg-dark">
			<div class="sidebar-content">

				<ul class="nav nav-primary">
					<li class="nav-item active">
						<a href="dashboard.php" class="collapsed">
							<i class="fas fa-home"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-section">
						<span class="sidebar-mini-icon">
							<i class="fa fa-ellipsis-h"></i>
						</span>
						<h4 class="text-section">Main Utama</h4>
					</li>
					<li class="nav-item">
						<a data-toggle="collapse" href="#base">
							<i class="fas fa-folder-open"></i>
							<p>Data Umum</p>
							<span class="caret"></span>
						</a>
						<div class="collapse" id="base">
							<ul class="nav nav-collapse">
								<li>
									<a href="?page=master&act=kelas">
										<span class="sub-item">Kelas</span>
									</a>
								</li>

								<li>
									<a href="?page=master&act=semester">
										<span class="sub-item">Semester</span>
									</a>
								</li>

								<li>
									<a href="?page=master&act=ta">
										<span class="sub-item">Tahun Pelajaran</span>
									</a>
								</li>
								<li>
									<a href="?page=master&act=mapel">
										<span class="sub-item">Mata Pelajaran</span>
									</a>
								</li>
								<li>
									<a href="?page=walas">
										<span class="sub-item"> Wali Kelas </span>
									</a>
								</li>
								<li>
									<a href="?page=siswa">
										<span class="sub-item"> Siswa </span>
									</a>
								</li>
							</ul>
						</div>
					</li>
			
					<li class="nav-item">
						<a href="?page=guru">
							<i class="fas fa-user-tie"></i>
							<p>Data Guru</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?page=jadwal">
							<i class="fas fa-clipboard-list"></i>
							<p>Jadwal</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?page=rapot">
							<i class="fas fa-file-signature"></i>
							<p>Rapot</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?page=jadwal&act=req">
							<i class="fas fa-fw fa-random"></i>
							<p>Request Jadwal</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?page=waktu">
							<i class="fas fa-fw fa-clock"></i>
							<p>Jam</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?page=laporan">
							<i class="fas fa-clipboard-check"></i>
							<p>Laporan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?page=generate">
							<i class="fas fa-calendar-alt"></i>
							<p>Buat Jadwal</p>
						</a>
					</li>
					<li class="nav-item active mt-3">
						<a href="#" class="collapsed" data-toggle="modal" onclick="confirmLogout()">
							<i class="fas fa-arrow-alt-circle-left"></i>
							<p>Keluar</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main-panel">
		<div class="content">
			<?php
			error_reporting();
			$page = @$_GET['page'];
			$act = @$_GET['act'];

			if ($page == 'master') {
				if ($act == 'kelas') {
					include 'modul/master/kelas/data_kelas.php';
				} elseif ($act == 'delkelas') {
					include 'modul/master/kelas/del.php';
				} elseif ($act == 'semester') {
					include 'modul/master/semester/data.php';
				} elseif ($act == 'delsemester') {
					include 'modul/master/semester/del.php';
				} elseif ($act == 'set_semester') {
					include 'modul/master/semester/set.php';
				}
				elseif ($act == 'ta') {
					include 'modul/master/ta/data.php';
				} elseif ($act == 'delta') {
					include 'modul/master/ta/del.php';
				} elseif ($act == 'set_ta') {
					include 'modul/master/ta/set.php';
				} elseif ($act == 'mapel') {
					include 'modul/master/mapel/data.php';
				} elseif ($act == 'delmapel') {
					include 'modul/master/mapel/del.php';
				}
			} elseif ($page == 'walas') {
				if ($act == '') {
					include 'modul/wakel/data.php';
				}
			} elseif ($page == 'rapot') {
				if ($act == '') {
					include 'modul/rapot/data.php';
				}
			} elseif ($page == 'generate') {
				if ($act == '') {
					include 'modul/generate/index.php';
				} elseif ($act == 'del') {
					include 'modal/generate/hapus-jadwal.php';
				}
			} elseif ($page == 'waktu') {
				if ($act == '') {
					include 'modul/waktu/jam.php';
				} elseif ($act == 'del') {
					include 'modal/waktu/del.php';
				}
			} elseif ($page == 'kepsek') {
				if ($act == '') {
					include 'modul/kepsek/data.php';
				} elseif ($act == 'add') {
					include 'modul/kepsek/add.php';
				} elseif ($act == 'edit') {
					include 'modul/kepsek/edit.php';
				} elseif ($act == 'del') {
					include 'modul/kepsek/del.php';
				} elseif ($act == 'proses') {
					include 'modul/kepsek/proses.php';
				}
			} elseif ($page == 'guru') {
				if ($act == '') {
					include 'modul/guru/data.php';
				} elseif ($act == 'edit') {
					include 'modul/guru/edit.php';
				} elseif ($act == 'del') {
					include 'modul/guru/del.php';
				} elseif ($act == 'proses') {
					include 'modul/guru/proses.php';
				}
			} elseif ($page == 'siswa') {
				if ($act == '') {
					include 'modul/siswa/data.php';
				} elseif ($act == 'add') {
					include 'modul/siswa/add.php';
				} elseif ($act == 'edit') {
					include 'modul/siswa/edit.php';
				} elseif ($act == 'del') {
					include 'modul/siswa/del.php';
				} elseif ($act == 'proses') {
					include 'modul/siswa/proses.php';
				}
			} elseif ($page == 'jadwal') {
				if ($act == '') {
					include 'modul/jadwal/data_mengajar.php';
				} elseif ($act == 'cancel') {
					include 'modul/jadwal/cancel.php';
				} elseif ($act == 'req') {
					include 'modul/jadwal/rjadwal.php';
				}
			} elseif ($page == 'laporan') {
				if ($page == 'laporan') {
					if ($act == '') {
						include 'modul/laporan/laporan.php';
					}
				} elseif ($page == '') {
					include 'modul/home.php';
				} else {
					echo "<b>Tidak ada Halaman</b>";
				}
			} elseif ($page == '') {
				include 'modul/home.php';
			} else {
				echo "<b>Tidak ada Halaman</b>";
			}
			?>
		</div>

		<div class="modal fade bs-example-modal-sm" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="gantiPass">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="gantiPass">Ganti Password</h4>
					</div>
					<form action="" method="post">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label">Password Lama</label>
								<input name="pass" type="text" class="form-control" placeholder="Password Lama">
							</div>
							<div class="form-group">
								<label class="control-label">Password Baru</label>
								<input name="pass1" type="text" class="form-control" placeholder="Password Baru">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button name="changePassword" type="submit" class="btn btn-primary">Ganti
								Password</button>
						</div>
					</form>
					<?php
					if (isset($_POST['changePassword'])) {
						$passLama = $data['password'];
						$pass = sha1($_POST['pass']);
						$newPass = sha1($_POST['pass1']);

						if ($passLama == $pass) {
							$set = mysqli_query($con, "UPDATE tb_admin SET password='$newPass' WHERE id_admin='$data[id_admin]' ");
							echo "<script type='text/javascript'>
				alert('Password Telah berubah')
				window.location.replace('dashboard.php'); 
				</script>";
						} else {
							echo "<script type='text/javascript'>
				alert('Password Lama Tidak cocok')
				window.location.replace('dashboard.php'); 
				</script>";
						}
					}
					?>
				</div>
			</div>
		</div>

		<script>
			function confirmLogout() {
				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: 'Anda akan keluar dari halaman ini.',
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Keluar'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = '../template/logout.php';
					}
				});
			}
		</script>

		<div class="modal fade" id="pengaturanAkun" tabindex="-1" role="dialog" aria-labelledby="akunAtur">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="akunAtur"><i class="fas fa-user-cog"></i> Pengaturan Akun</h3>
					</div>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group" style="text-align: center;">
								<div style="position: relative; display: inline-block;">
									<p>
										<img src="../assets/img/user/<?= $data['foto'] ?>" style="height: 100px; width: 100px; border-radius: 50%;" id="profile-image">
									</p>
									<label for="upload" style="cursor: pointer; color: blue; text-decoration: underline; display: block; margin: 10px auto;">Edit Foto</label>
									<input type="file" name="foto" id="upload" style="display: none;">
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="nama" class="form-control" value="<?= $data['nama_lengkap'] ?>">
								<input type="hidden" name="id" value="<?= $data['id_admin'] ?>">
							</div>
							<div class="form-group">
								<input type="text" name="username" class="form-control" value="<?= $data['username'] ?>">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button name="updateProfile" type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
					<?php
					if (isset($_POST['updateProfile'])) {

						$gambar = @$_FILES['foto']['name'];
						if (!empty($gambar)) {
							move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/user/$gambar");
							$ganti = mysqli_query($con, "UPDATE tb_admin SET foto='$gambar' WHERE id_admin='$_POST[id]' ");
						}

						$sqlEdit = mysqli_query($con, "UPDATE tb_admin SET nama_lengkap='$_POST[nama]',username='$_POST[username]' WHERE id_admin='$_POST[id]' ") or die(mysqli_error($konek));

						if ($sqlEdit) {
							echo "<script>
                        alert('Sukses ! Data berhasil diperbarui');
                        window.location='dashboard.php';
                        </script>";
						}
					}
					?>
				</div>
			</div>
		</div>
		<!-- <footer class="footer">
			<div class="container">
				<div class="copyright ml-auto">
					&copy;
					<?php echo date('Y'); ?> SDN 11 Sangku (<a href="index.php">Desto Tabaru </a> | 2023/2024)
				</div>
			</div>
		</footer> -->
	</div>

	</div>
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="../assets/js/atlantis.min.js"></script>
	<script src="../assets/js/setting-demo.js"></script>
	<script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({});

			$('#multi-filter-select').DataTable({
				"pageLength": 5,
				initComplete: function() {
					this.api().columns().every(function() {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function() {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);

								column
									.search(val ? '^' + val + '$' : '', true, false)
									.draw();
							});

						column.data().unique().sort().each(function(d, j) {
							select.append('<option value="' + d + '">' + d + '</option>')
						});
					});
				}
			});

			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
				]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>

</html>