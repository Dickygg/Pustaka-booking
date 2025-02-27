<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-3">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#kategoriBaruModal"><i class="fas fa-file-alt"></i> Tambah Kategori</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($kategori as $k) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $k['kategori']; ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#kategorieditModal"
                                    class="badge badge-info"
                                    data-id="<?= $k['id']; ?>"
                                    data-kategori="<?= $k['kategori']; ?>">
                                    <i class="fas fa-edit"></i> Ubah
                                </a>

                                <a href="<?=
                                            base_url('buku/hapuskategori/') . $k['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $k['kategori']; ?>?');" class="badge badge-danger"><i class="fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal Tambah kategori baru-->
<div class="modal fade" id="kategoriBaruModal" tabindex="-1"
    role="dialog" aria-labelledby="kategoriBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="kategoriBaruModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('buku/kategori'); ?>"
                method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kategori" name="kategori" placeholder="Masukkan Kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i
                            class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal tambah Mneu -->
<!-- Modal Edit Kategori -->
<div class="modal fade" id="kategorieditModal" tabindex="-1"
    role="dialog" aria-labelledby="kategorieditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('buku/editkategori'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="text" class="form-control form-control-user" id="edit-kategori" name="kategori" placeholder="Masukkan Kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.badge-info', function() {
        let id = $(this).data('id');
        let kategori = $(this).data('kategori');

        console.log("ID yang diambil:", id);
        console.log("Kategori yang diambil:", kategori);

        $('#edit-id').val(id);
        $('#edit-kategori').val(kategori);
    });
</script>

<!--- tambahkan script ini     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> view-diheader