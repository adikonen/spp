<?php $petugas = $data['petugas'];?>

<div>
    <div class="d-flex mb-2">
        <h4>Edit Petugas</h4>
    </div>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_petugas/update/<?= e($petugas['id_pengguna'])?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="<?= e($petugas['username'])?>">
            </div>
            <div class="mb-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="<?= e($petugas['password'])?>">
                <input type="checkbox" class="m-2" id="showPass"><label for="showPass">Lihat Password</label>
            </div>
            <div class="mb-3">
                <label for="nama_petugas" class="form-label">Nama Petugas</label>
                <input type="text" name="nama_petugas" class="form-control" id="nama_petugas" value="<?= e($petugas['nama_petugas'])?>">
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL?>/admin_petugas" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
    $('#showPass').change((e) => {
        let type = $('#password').attr('type');
        if (type === 'password') {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });
</script>