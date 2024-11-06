<?php
include '../../../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Laporan</title>
	<link rel="icon" type="image/png" href="../../../assets/img/logo-sd.png" />
</head>

<body>
	<br>
	<center>
		<table>
			<tr>
				<td><img src="../../../assets/img/logo-sd.png" width="90" height="90"></td>
				<td>
					<center>
						<font size="5"><strong>JADWAL MATA PELAJARAN</strong></font><br>
						<font size="5"><strong>SEKOLAH DASAR NEGERI 11 SANGKU</strong></font><br>
						<font size="3">Alamat : Jalan Raya Sangku Desa Dara Itam 1 Kecamatan Jelimpo Kode Pos 79357
						</font>
					</center>
				</td>
			</tr>
		</table>
	</center>
	<br>
	<div class="card-body">
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
					/* Add padding for better appearance */
				}
			</style>
			<table id="basic-datatables">
				<tr>
					<th>No.</th>
					<th>Hari</th>
					<th>Waktu</th>
					<th>Nama Guru</th>
					<th>Mata Pelajaran</th>
					<th>Kelas</th>
				</tr>
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
					<tr class="text" align="center">
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
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	<br>
	<table align="center" width="100%">
		<table width="100%" align="center">
			<tr>
				<td width="80%"></td>
				<td class="text2" align="center">Kepala Sekolah<br>SDN 11 Sangku<br><br><br><br>Martinus Bakri S.Pd.
				</td>
			</tr>

		</table>
	</table>
</body>
<script>
	window.print()
</script>

</html>