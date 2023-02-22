<?php 
$idKelas = $siswa['id_kelas'] ?? null;
$idPembayaran = $siswa['id_pembayaran'] ?? null;    

?>

<div class="mb-3">
    <label for="nis" class="form-label">Nis <small>(akan sebagai username siswa)</small></label>
    <input type="number" name="nis" class="form-control" id="nis" value="<?= e($siswa['nis'] ?? null)?>">
</div>
<div class="mb-3">
    <label for="nisn" class="form-label">Nisn</label>
    <input type="number" name="nisn" id="nisn" class="form-control" value="<?= e($siswa['nisn'] ?? null)?>">
</div>
<div class="mb-3">
    <label for="nama" class="form-label">Nama Siswa</label>
    <input type="text" name="nama" class="form-control" id="nama" value="<?= e($siswa['nama'] ?? null)?>">
</div>
<div class="mb-1">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password" value="<?= e($siswa['password'] ?? null)?>">
    <input type="checkbox" class="mt-3 mr-2" id="showPass"><label for="showPass">Lihat Password</label>
</div>
<div class="mb-3">
    <label for="telepon" class="form-label">No Telepon</label>
    <input type="number" name="telepon" id="telepon" class="form-control" value="<?= e($siswa['telepon'] ?? null)?>">
</div>
<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" name="alamat" id="alamat" class="form-control" value="<?= e($siswa['alamat'] ?? null )?>" >
</div>
<div class="mb-3">
    <label for="id_kelas" class="form-label">Kelas</label>
    <select name="id_kelas" id="id_kelas" class="form-control">
        <?php foreach($data['all_kelas'] as $kelas):?>
            <option value="<?= e($kelas['id_kelas'])?>" <?php if ($kelas['id_kelas'] === $idKelas):?> selected <?php endif;?> ><?= e($kelas['nama_kelas'])?></option>
        <?php endforeach;?>
    </select>
</div>
<div class="mb-3">
<label for="id_pembayaran" class="form-label">Spp</label>
    <select name="id_pembayaran" id="id_pembayaran" class="form-control">
        <?php foreach($data['all_pembayaran'] as $pembayaran):?>
            <option value="<?= e($pembayaran['id_pembayaran'])?>" <?php if ($pembayaran['id_pembayaran'] === $idPembayaran):?> selected <?php endif;?> ><?= e($pembayaran['tahun_ajaran'])?></option>
        <?php endforeach;?>
    </select>
</div>
<button class="btn btn-primary">Simpan</button>
<a href="<?= BASE_URL?>/admin_siswa" class="btn btn-secondary">Kembali</a>

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