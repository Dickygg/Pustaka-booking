<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <a href="<?php echo base_url('siswa/tambahdata') ?>" class="btn btn-primary btn-sm float-right">Tambah data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>no</th>

                        <th>Nama</th>
                        <th>Nis</th>
                        <th>Kelas</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $s) { ?>

                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= $s->nama ?></td>
                            <td><?= $s->nis ?></td>
                            <td><?= $s->kelas ?></td>
                            <td><?= $s->tanggal ?></td>
                            <td><?= $s->alamat ?></td>
                            <td><?= $s->jenis_kelamin ?></td>
                            <td><?= $s->agama ?></td>



                            <td class="g-10"><a class="btn btn-danger" href="<?= base_url('siswa/delete/') . $s->kd_siwa; ?>" onclick="return confirm('kamu yakin menghapus<?= $s->nama . '' . $s->nama; ?>')">
                                    Hapus
                                </a>
                                <a class="btn btn-primary">
                                    Edit
                                </a>
                            </td>

                        </tr>
                    <?php }


                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>