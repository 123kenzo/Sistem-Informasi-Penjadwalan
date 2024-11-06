<?php
$del = mysqli_query($con, "DELETE FROM tb_rjadwal WHERE id_rjadwal=$_GET[id]");
if ($del) {
	echo " 
	<script>
		Swal.fire({
			icon: 'success',
			title: 'Sukses',
			text: 'Data berhasil dihapus!',
		}).then((result) => {
			if (result.isConfirmed) {
				window.location = '?page=requesjadwal';
			}
		});
		</script>";
}
