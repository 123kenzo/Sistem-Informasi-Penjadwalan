<?php
date_default_timezone_set("Asia/jakarta");
?>
<div class="panel-header bg-dark2">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Administrator</h2>
				<h5 class="text-white op-7 mb-2">Selamat Datang, <b class="text-warning">
						<?= $data['nama_lengkap']; ?>
					</b> | Aplikasi Penjadwalan</h5>
				<h5 id="tanggalJam" style="font-size: 18px; font-weight: bold; color: white;"></h5>
			</div>
		</div>
	</div>
</div>

<div class="page-inner mt--5">
	<div class="row mt--2">
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card h-40">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Total Guru</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahGuru; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card h-40">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Siswa</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">298</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card h-40">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Total Mapel</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
						</div>
						<div class="col-auto">
							<i class="fab fa-wpforms fa-2x text-success"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card h-40">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase mb-1">Total Kelas</div>
							<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">6</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-building fa-2x text-info"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-inner mt--5">
	<div class="row mt--5">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-body text-center">
					<div class="card-title">
						<img src="../assets/img/logo-sd.png" width="100">
						<br>
						<b>SDN 11 SANGKU</b>
					</div>
					<div class="card-category">
						<a href="https://www.google.com/maps?q=Jl.+Raya+Sangku+-+Desa+Dara+Itam+Kec.+Jelimpo+Kab.+Landak+Kode+Pos+79357" target="_blank">
							Jl. Raya Sangku - Desa Dara Itam Kec. Jelimpo Kab. Landak Kode Pos 79357
						</a>
						<br>
						Email : sdn11sangku@gmail.com Telp.0895022
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function() {
		tanggalJam();
	}

	function tanggalJam() {
		var element = document.getElementById('tanggalJam'),
			dateObject = new Date(),
			hours, minutes, seconds, day, month, year;

		var daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
		var monthsOfYear = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

		hours = dateObject.getHours();
		minutes = set(dateObject.getMinutes());
		seconds = set(dateObject.getSeconds());
		day = daysOfWeek[dateObject.getDay()];
		date = set(dateObject.getDate());
		month = monthsOfYear[dateObject.getMonth()]; 
		year = dateObject.getFullYear();

		// format "Hari, dd Bulan yyyy Jam:mm:ss"
		element.innerHTML = day + ', ' + date + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds;

		setTimeout(tanggalJam, 1000);
	}

	function set(e) {
		e = e < 10 ? '0' + e : e;
		return e;
	}
</script>