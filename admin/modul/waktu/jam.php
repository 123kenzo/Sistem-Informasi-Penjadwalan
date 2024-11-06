<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-bordered">
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
                    <table id="basic-datatables" class="table table-bordered">
                        <thead>
                            <tr class="text-center" style="font-weight:bold;">
                                <th scope="col">No</th>
                                <th scope="col">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $jam = mysqli_query($con, "SELECT * FROM tb_jam");
                            foreach ($jam as $k) { ?>
                                <tr class="text-center">
                                    <td><b>
                                            <?= $no++; ?>.
                                        </b></td>
                                    <td>
                                        <?= $k['jam']; ?>
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