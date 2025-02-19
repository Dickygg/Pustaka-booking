<div class="container fluid">
    <h3>Halaman Tambah data</h3>
    <hr>
    <br>
    <form method="post" action="<?php echo base_url('menu/proses_tambahmenu'); ?>" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="mmmenu" class="col-sm-2 col-form-label">Nama Menu</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="mmmenu">
            </div>
        </div>
        <div class="row mb-3">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="harga">
            </div>
        </div>
        <div class="row mb-3">
            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-5">
                <input type="file" class="form-control" name="gambar" required accept=".jpg,.jpeg,.png">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>


</div>