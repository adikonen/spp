<div>
    <div class="d-flex mb-2">
        <h4>Tambah Siswa</h4>
    </div>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin/siswa_store" method="post">
            <?php include('_inputs.php')?>
            <!-- <div class="mb-3">
                <label for="username" class="form-label">Nis <small>(akan sebagai username siswa)</small></label>
                <input type="number" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">Nisn</label>
                <input type="number" name="nisn" id="nisn" class="form-control">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Siswa</label>
                <input type="text" name="nama" class="form-control" id="nama">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">No Telepon</label>
                <input type="number" name="telepon" id="telepon" class="form-control">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control">
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-control">
                    <?php foreach($data['all_kelas'] as $kelas):?>
                        <option value="<?= e($kelas['id_kelas'])?>"><?= e($kelas['nama_kelas'])?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL?>/admin/siswa" class="btn btn-secondary">Kembali</a> -->
        </form>
    </div>
</div>
