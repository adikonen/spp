<?php $kelas = $data['kelas'];?>

<div>
    <div class="d-flex mb-2">
        <h4 class="text-capitalize">Edit kelas</h4>
    </div>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_kelas/update/<?= e($kelas['id_kelas'])?>" method="post">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label text-capitalize">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="<?= e($kelas['nama_kelas'])?>">
            </div>
            <div class="mb-3">
                <label for="kompetensi_keahlian" class="form-label text-capitalize">Kompetensi Keahlian</label>
                <input type="text" name="kompetensi_keahlian" class="form-control" id="kompetensi_keahlian" value="<?= e($kelas['kompetensi_keahlian'])?>">
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL?>/admin/kelas" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
