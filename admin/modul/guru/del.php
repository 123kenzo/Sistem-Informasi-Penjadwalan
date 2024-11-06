<?php 
$del = mysqli_query($con,"DELETE FROM tb_guru WHERE id_guru=$_GET[id]");
if ($del) {
		echo " 
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Data berhasil dihapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '?page=guru';
                }
            });
        </script>";
}