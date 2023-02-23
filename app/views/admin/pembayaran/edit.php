<?php $pembayaran = $data['pembayaran'];?>

<div>
    <div class="d-flex mb-2">
        <h4 class="text-capitalize">Edit pembayaran</h4>
    </div>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_pembayaran/update/<?= e($pembayaran['id_pembayaran'])?>" method="post">
            <div class="mb-3">
                <label for="nominal" class="form-label text-capitalize">Nominal</label>
                <input type="number" name="nominal" class="form-control" id="nominal" value="<?= e($pembayaran['nominal'])?>">
            </div>
            <div class="mb-3">
                <label for="tahun_ajaran" class="form-label text-capitalize">tahun ajaran</label>
                <input type="number" name="tahun_ajaran" class="form-control" id="tahun_ajaran" value="<?= e($pembayaran['tahun_ajaran'])?>">
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL?>/admin_pembayaran" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
