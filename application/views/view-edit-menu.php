<div class="container fluid">
    <h3>Halaman Edit data</h3>
    <hr>
    <br>
    <form method="post" action="<?php echo base_url('menu/prosesedit'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="kd_menu" value="<?= $menu->kd_menu; ?>">

        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama menu</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="mmmenu" required="" value="<?= $menu->mmmenu; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nim" class="col-sm-2 col-form-label">harga</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="harga" required="" value="<?= $menu->harga; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-5">
                <input type="file" class="form-control" name="gambar" accept=".jpg,.jpeg,.png">
                <br>
                <img src="<?= base_url('uploads/' . $menu->gambar) ?>" width="100">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
    <script>
        //untuk user exprience tapi bisa lebih mudah dengan accept="jpg,png" di input formnya
        document.querySelector("form").addEventListener("submit", function(e) {
            var fileInput = document.querySelector("input[name='gambar']");
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            if (fileInput.files.length > 0 && !allowedExtensions.exec(filePath)) {
                alert("Format file harus JPG, JPEG, atau PNG!");
                fileInput.value = "";
                e.preventDefault(); // Batalkan submit
            }
        });
    </script>


</div>