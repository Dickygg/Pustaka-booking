<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <!-- <a href="<?php echo base_url('menu/tambahmenu') ?>" class="btn btn-primary btn-sm float-right">Tambah data</a> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>no</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Member Sejak</th>
                        <th>Profile</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($anggota as $a) { ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['email']; ?></td>
                            <td><?= date('d F Y', $a['tanggal_input']); ?></td>
                            <td>
                                <img src="<?= base_url('assets/sbadmin/img/profile/') . $a['image'] ?>" width="100" onerror="this.onerror=null; this.src='<?= base_url('uploads/eror.png') ?>';">
                            </td>

                            <!-- <td><a class="btn btn-danger a-center postion-absolute top-10px" href="<?php echo site_url('menu/delete/' . $m->kd_menu); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                    Hapus
                                </a>
                                <a class="btn btn-primary" href="<?php echo site_url('menu/editdata/' . $m->kd_menu); ?>">
                                    Edit
                                </a>
                            </td> -->

                        </tr>
                    <?php }


                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>