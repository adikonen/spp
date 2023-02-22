<div>
    <div class="d-flex mb-2">
        <h4>Tambah Petugas</h4>
    </div>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_petugas/store" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="nama_petugas" class="form-label">Nama Petugas</label>
                <input type="text" name="nama_petugas" class="form-control" id="nama_petugas">
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL?>/admin_petugas" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>