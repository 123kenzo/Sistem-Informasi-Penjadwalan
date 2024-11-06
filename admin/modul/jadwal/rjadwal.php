<div class="page-inner">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
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
                  <th>No</th>
                  <th>Nama</th>
                  <th>Hari</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $rjadwal = mysqli_query($con, "SELECT * FROM tb_rjadwal");
                foreach ($rjadwal as $g) { ?>
                  <tr class="text-center">
                    <td>
                      <?= $no++; ?>.
                    </td>
                    <td>
                      <?= $g['nama_guru']; ?>
                    </td>
                    <td>
                      <?= $g['hari']; ?>
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