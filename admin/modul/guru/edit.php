<?php
$edit = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru='$_GET[id]' ");
foreach ($edit as $d) ?>
<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Guru</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="#">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Data Guru</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Edit Guru</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Edit Data Guru</h3>
				</div>
				<div class="card-body">
					<form action="?page=guru&act=proses" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>NIP/NUPTK</label>
									<input type="hidden" name="id" value="<?= $d['id_guru'] ?>">
									<input name="nip" type="text" class="form-control" value="<?= $d['nip'] ?>"
										readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Nama Guru</label>
									<input name="nama" type="text" class="form-control" value="<?= $d['nama_guru'] ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Alamat</label>
									<input name="alamat" type="text" class="form-control" value="<?= $d['alamat'] ?>">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-4">
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<input name="jk" type="text" class="form-control" value="<?= $d['jenis_kelamin'] ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Jabatan</label>
									<input name="jabatan" type="text" class="form-control" value="<?= $d['jabatan'] ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<p>
										<img src="../assets/img/user/<?= $d['foto']; ?>"
											class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
									</p>
									<label>Foto</label>
									<input type="file" name="foto">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<button name="editGuru" type="submit" class="btn btn-primary"><i
											class="fa fa-save"></i>Update</button>
									<a href="javascript:history.back()" class="btn btn-warning"><i
											class="fa fa-chevron-left"></i> Batal</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>