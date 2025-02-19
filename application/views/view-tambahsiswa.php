<div class="container fluid">
    <h3>Halaman Tambah data</h3>
    <hr>
    <br>
    <form method="post" action="<?php echo base_url('siswa/proses_tambahsiswa'); ?>" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="nama">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nis" class="col-sm-2 col-form-label">Nis</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="nis">
            </div>
        </div>
        <div class="row mb-3">
            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="kelas">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" name="tanggal">
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="alamat">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-5">
                <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Agama</label>
            <div class="col-sm-5">
                <select class="form-control" name="agama">
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
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