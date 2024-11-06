<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-file-signature mr-2"></i><strong>Buat Raport SD</strong></h3>
                    <form action="proses_raport.php" method="POST">
                        <div class="form-group">
                            <label for="student_name">Nama Siswa</label>
                            <input type="text" name="student_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Mata Pelajaran</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jam">Jam</label>
                            <select name="jam" class="form-control" required>
                                <?php
                                $jam = mysqli_query($con, "SELECT * FROM tb_jam");
                                foreach ($jam as $k) { ?>
                                    <option value="<?= $k['jam']; ?>"><?= $k['jam']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Buat Raport</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
