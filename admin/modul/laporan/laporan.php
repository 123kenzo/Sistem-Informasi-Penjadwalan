<div class="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header table-bordered">
					<div class="card-title" style="text-align: center; font-weight: bold;">
						LAPORAN JADWAL MATA PELAJARAN
					</div>
					<p class="card-title" style="text-align: center; font-weight: bold;">
						SEKOLAH DASAR NEGERI 11 SANGKU
					</p>
					<div class="additional-text" style="text-align: center; font-weight: bold;">
						Alamat : Jalan Raya Sangku Desa Dara Itam 1 Kecamatan Jelimpo Kode Pos 79357
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
							<tr class="text-center">
								<th>No.</th>
								<th>Hari</th>
								<th>Waktu</th>
								<th>Mata Pelajaran</th>
								<th>Kelas</th>
								<th>Nama Guru</th>
								<th>TP/Semester</th>
							</tr>

							<tbody>
								<strong>
									<h3>
										<?= $jd['mapel']; ?>
									</h3>
								</strong>
								<?php
								foreach ($mengajar as $jd) {
								?>
								<?php } ?>
								<?php
								$no = 1;
								$mapel = mysqli_query($con, "SELECT * FROM tb_mengajar 
                            		INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
                           	 		INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
                            		INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
                            		INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
                            		INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran");
								foreach ($mapel as $d) {
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
											<?= $d['mapel'] ?>
										</td>
										<td>
											<?= $d['nama_kelas'] ?>
										</td>
										<td>
											<?= $d['nama_guru'] ?>
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
	<div class="row">
		<div class="col-md-12 text-right">
			<a href="../admin/modul/laporan/cetak.php" class="btn btn-primary btn-sm text-white"><i class="fa fa-print"></i> Cetak</a>
		</div>
	</div>

</div>