<?php
include '../../../config/db.php';

if (isset($_POST['save'])) {

    $guru = mysqli_query($con, "SELECT * FROM tb_guru");
    $mapel = mysqli_query($con, "SELECT * FROM tb_master_mapel");
    $mkelas = mysqli_query($con, "SELECT * FROM tb_mkelas");
    $semester = mysqli_query($con, "SELECT * FROM tb_semester");
    $thajaran = mysqli_query($con, "SELECT * FROM tb_thajaran");
    $jam = mysqli_query($con, "SELECT * FROM tb_jam");
    $hari = mysqli_query($con, "SELECT * FROM tb_hari");

    mysqli_query($con, "DELETE FROM tb_mengajar");

    $count = 0;
    foreach ($guru as $g) {
        foreach ($mapel as $m) {
            foreach ($mkelas as $mk) {
                foreach ($jam as $j) {
                    foreach ($hari as $h) {
                        foreach ($semester as $s) {
                            foreach ($thajaran as $th) {
                                $queryInsert = "INSERT INTO tb_mengajar (id_guru, id_mapel, id_mkelas, id_semester, id_thajaran, hari, jam_mengajar, jamke) 
                                                VALUES ('" . $g['id_guru'] . "', '" . $m['id_mapel'] . "', '" . $mk['id_mkelas'] . "', '" . $s['id_semester'] . "', '" . $th['id_thajaran'] . "', '" . $h['hari'] . "', '" . $j['jam'] . "', '" . $j['jamke'] . "')";
                                mysqli_query($con, $queryInsert);

                                $count++;

                                if ($count >= 5) {
                                    break 7;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    mysqli_query($con, "DELETE FROM tb_mengajar");
    echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Data berhasil dihapus!',
            });
        </script>";
}

$no = 1;
$mengajar = mysqli_query($con, "SELECT * FROM tb_mengajar 
            INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
            INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
            INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
            INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
            INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran");

?>

<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header table-bordered">
                        <h2 class="m-0 font-weight-bold text-primary text-center">PROSES JADWAL</h2>
                    </div>
                    <div class="card-body table-bordered">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" onclick="toggleProgress()" name="save" id="proses-button" class="btn btn-primary">
                                            <i class="fas fa-paper-plane"></i> Proses
                                        </button>
                                        <button type="submit" name="hapus" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Hapus Semua Jadwal
                                        </button>
                                        <a href="#" class="btn btn-warning btn-lm text-white" data-toggle="modal" data-target="#cekModal"><i class="fas fa-search"></i> Cek Bentrok</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleProgress() {
            $('#proses-button').html('<i class="fas fa-circle-notch fa-spin"></i> Memproses...');

            setTimeout(function() {
                $('form').submit();
            }, 500);
        }
    </script>

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header table-bordered">
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
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Nama Guru</th>
                                        <th>TP/Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($mengajar as $d) {
                                    ?>
                                        <tr class="text-center">
                                            <th scope="row"><b><?= $no++; ?>.</b></th>
                                            <td><?= $d['hari']; ?></td>
                                            <td><?= $d['jam_mengajar']; ?></td>
                                            <td><?= $d['mapel'] ?></td>
                                            <td><?= $d['nama_kelas'] ?></td>
                                            <td><?= $d['nama_guru'] ?></td>
                                            <td><?= $d['tahun_ajaran'] ?>/<?= $d['semester'] ?></td>
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

    <div class="modal fade" id="cekModal" tabindex="-2" role="dialog" aria-labelledby="cekModalLabel" aria-hidden="true">
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
                    <h2 class="modal-title" id="cekModal" style="margin-left: 50%;
                        transform: translateX(-50%); font-weight: bold; display: inline-block; color:blue;">JADWAL BENTROK</h2>
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

                                    if (!$mengajar) {
                                        echo "
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Terjadi kesalahan dalam mengambil data!',
                                                });
                                            </script>";
                                    } else {
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
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<div class="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header table-bordered">
					<div class="card-title" style="text-align: center; font-weight: bold;">
						JADWAL MATA PELAJARAN PER KELAS
					</div>
					<p class="card-title" style="text-align: center; font-weight: bold;">
						SEKOLAH DASAR NEGERI 11 SANGKU
					</p>
					<div class="additional-text" style="text-align: center; font-weight: bold;">
						Alamat: Jalan Raya Sangku Desa Dara Itam 1 Kecamatan Jelimpo Kode Pos 79357
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
						<table id="basic-datatables" class="table table-bordered">
							<thead>
								<tr class="text-center bg-primary text-white">
									<th>No.</th>
									<th>Kelas</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-center">
									<td><b>1</b></td>
									<td>Jadwal Kelas 1</td>
									<td>
										<a href="#" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#jadwal1modal">Lihat Jadwal</a>
									</td>
								</tr>
								<tr class="text-center">
									<td><b>2</b></td>
									<td>Jadwal Kelas 2</td>
									<td>
									<a href="#" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#jadwal2modal">Lihat Jadwal</a>
									</td>
								</tr>
								<tr class="text-center">
									<td><b>3</b></td>
									<td>Jadwal Kelas 3</td>
									<td>
									<a href="#" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#jadwal3modal">Lihat Jadwal</a>
									</td>
								</tr>
								<tr class="text-center">
									<td><b>4</b></td>
									<td>Jadwal Kelas 4</td>
									<td>
									<a href="#" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#jadwal4modal">Lihat Jadwal</a>
									</td>
								</tr>
								<tr class="text-center">
									<td><b>5</b></td>
									<td>Jadwal Kelas 5</td>
									<td>
									<a href="#" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#jadwal5modal">Lihat Jadwal</a>
									</td>
								</tr>
								<tr class="text-center">
									<td><b>6</b></td>
									<td>Jadwal Kelas 6</td>
									<td>
									<a href="#" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#jadwal6modal">Lihat Jadwal</a>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="modal fade" id="jadwal1modal" tabindex="-2" role="dialog" aria-labelledby="jd1ModalLabel" aria-hidden="true">
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
										<h2 class="modal-title" id="jadwal1modal" style="margin-left: 50%;
                    						transform: translateX(-50%); font-weight: bold; display: inline-block; 
                    						color: blue;">Jadwal Mata Pelajaran Kelas 1</h2>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="card-body table-bordered">
											<div class="table-responsive">
												<style>
													#detail-datatables {
														border-collapse: collapse;
														width: 100%;
														border-spacing: 0;
													}

													#detail-datatables th,
													#detail-datatables td {
														border: 1pt solid black;
														padding: 8px;
													}
												</style>
												<table id="detail-datatables" class="table table-bordered">
													<thead class="bg-primary text-white text-center">
														<tr>
															<th>No.</th>
															<th>Waktu</th>
															<th>Senin</th>
															<th>Selasa</th>
															<th>Rabu</th>
															<th>Kamis</th>
															<th>Jumat</th>
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
																INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran ");
															foreach ($mengajar as $d) {
														?>
														<tr class="text-center">
															<th scope="row"><b>
																<?= $no++; ?>.
															</b></th>
															<td>
															<?= $d['jam_mengajar']; ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
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
						<div class="modal fade" id="jadwal2modal" tabindex="-2" role="dialog" aria-labelledby="jd1ModalLabel" aria-hidden="true">
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
										<h2 class="modal-title" id="jadwal2modal" style="margin-left: 50%;
                    						transform: translateX(-50%); font-weight: bold; display: inline-block; 
                    						color: blue;">Jadwal Mata Pelajaran Kelas 2</h2>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="card-body table-bordered">
											<div class="table-responsive">
												<style>
													#detail-datatables {
														border-collapse: collapse;
														width: 100%;
														border-spacing: 0;
													}

													#detail-datatables th,
													#detail-datatables td {
														border: 1pt solid black;
														padding: 8px;
													}
												</style>
												<table id="detail-datatables" class="table table-bordered">
													<thead class="bg-primary text-white text-center">
														<tr>
															<th>No.</th>
															<th>Waktu</th>
															<th>Senin</th>
															<th>Selasa</th>
															<th>Rabu</th>
															<th>Kamis</th>
															<th>Jumat</th>
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
																INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran ");
															foreach ($mengajar as $d) {
														?>
														<tr class="text-center">
															<th scope="row"><b>
																<?= $no++; ?>.
															</b></th>
															<td>
															<?= $d['jam_mengajar']; ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
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
						<div class="modal fade" id="jadwal3modal" tabindex="-2" role="dialog" aria-labelledby="jd1ModalLabel" aria-hidden="true">
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
										<h2 class="modal-title" id="jadwal3modal" style="margin-left: 50%;
                    						transform: translateX(-50%); font-weight: bold; display: inline-block; 
                    						color: blue;">Jadwal Mata Pelajaran Kelas 3</h2>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="card-body table-bordered">
											<div class="table-responsive">
												<style>
													#detail-datatables {
														border-collapse: collapse;
														width: 100%;
														border-spacing: 0;
													}

													#detail-datatables th,
													#detail-datatables td {
														border: 1pt solid black;
														padding: 8px;
													}
												</style>
												<table id="detail-datatables" class="table table-bordered">
													<thead class="bg-primary text-white text-center">
														<tr>
															<th>No.</th>
															<th>Waktu</th>
															<th>Senin</th>
															<th>Selasa</th>
															<th>Rabu</th>
															<th>Kamis</th>
															<th>Jumat</th>
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
																INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran ");
															foreach ($mengajar as $d) {
														?>
														<tr class="text-center">
															<th scope="row"><b>
																<?= $no++; ?>.
															</b></th>
															<td>
															<?= $d['jam_mengajar']; ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
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
						<div class="modal fade" id="jadwal4modal" tabindex="-2" role="dialog" aria-labelledby="jd1ModalLabel" aria-hidden="true">
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
										<h2 class="modal-title" id="jadwal4modal" style="margin-left: 50%;
                    						transform: translateX(-50%); font-weight: bold; display: inline-block; 
                    						color: blue;">Jadwal Mata Pelajaran Kelas 4</h2>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="card-body table-bordered">
											<div class="table-responsive">
												<style>
													#detail-datatables {
														border-collapse: collapse;
														width: 100%;
														border-spacing: 0;
													}

													#detail-datatables th,
													#detail-datatables td {
														border: 1pt solid black;
														padding: 8px;
													}
												</style>
												<table id="detail-datatables" class="table table-bordered">
													<thead class="bg-primary text-white text-center">
														<tr>
															<th>No.</th>
															<th>Waktu</th>
															<th>Senin</th>
															<th>Selasa</th>
															<th>Rabu</th>
															<th>Kamis</th>
															<th>Jumat</th>
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
																INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran ");
															foreach ($mengajar as $d) {
														?>
														<tr class="text-center">
															<th scope="row"><b>
																<?= $no++; ?>.
															</b></th>
															<td>
															<?= $d['jam_mengajar']; ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
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
						<div class="modal fade" id="jadwal5modal" tabindex="-2" role="dialog" aria-labelledby="jd1ModalLabel" aria-hidden="true">
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
										<h2 class="modal-title" id="jadwal5modal" style="margin-left: 50%;
                    						transform: translateX(-50%); font-weight: bold; display: inline-block; 
                    						color: blue;">Jadwal Mata Pelajaran Kelas 5</h2>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="card-body table-bordered">
											<div class="table-responsive">
												<style>
													#detail-datatables {
														border-collapse: collapse;
														width: 100%;
														border-spacing: 0;
													}

													#detail-datatables th,
													#detail-datatables td {
														border: 1pt solid black;
														padding: 8px;
													}
												</style>
												<table id="detail-datatables" class="table table-bordered">
													<thead class="bg-primary text-white text-center">
														<tr>
															<th>No.</th>
															<th>Waktu</th>
															<th>Senin</th>
															<th>Selasa</th>
															<th>Rabu</th>
															<th>Kamis</th>
															<th>Jumat</th>
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
																INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran ");
															foreach ($mengajar as $d) {
														?>
														<tr class="text-center">
															<th scope="row"><b>
																<?= $no++; ?>.
															</b></th>
															<td>
															<?= $d['jam_mengajar']; ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
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
						<div class="modal fade" id="jadwal6modal" tabindex="-2" role="dialog" aria-labelledby="jd6ModalLabel" aria-hidden="true">
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
										<h2 class="modal-title" id="jadwal6modal" style="margin-left: 50%;
                    						transform: translateX(-50%); font-weight: bold; display: inline-block; 
                    						color: blue;">Jadwal Mata Pelajaran Kelas 6</h2>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="card-body table-bordered">
											<div class="table-responsive">
												<style>
													#detail-datatables {
														border-collapse: collapse;
														width: 100%;
														border-spacing: 0;
													}

													#detail-datatables th,
													#detail-datatables td {
														border: 1pt solid black;
														padding: 8px;
													}
												</style>
												<table id="detail-datatables" class="table table-bordered">
													<thead class="bg-primary text-white text-center">
														<tr>
															<th>No.</th>
															<th>Waktu</th>
															<th>Senin</th>
															<th>Selasa</th>
															<th>Rabu</th>
															<th>Kamis</th>
															<th>Jumat</th>
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
																INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran ");
															foreach ($mengajar as $d) {
														?>
														<tr class="text-center">
															<th scope="row"><b>
																<?= $no++; ?>.
															</b></th>
															<td>
															<?= $d['jam_mengajar']; ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
															</td>
															<td>
															<?= $d['mapel'] ?>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
