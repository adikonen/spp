<div class="card p-3">
    <div class="table-responsive">
        <div class="alert alert-primary">Berikut adalah daftar siswa dalam sistem</div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>        
            <tbody>
            <?php foreach($data['all_siswa'] as $siswa):?>
                <tr>
                    <td><?= e($siswa['nis'])?></td>
                    <td><?= e($siswa['nama'])?></td>
                    <td><?= e($siswa['telepon'])?></td>
                    <td><?= e($siswa['nama_kelas'])?></td>
                    <td>
                        <a href="<?= BASE_URL?>/admin_siswa/edit/<?= e($siswa['id_pengguna'])?>" class="btn btn-warning">Edit</a>
                        <a href="<?= BASE_URL?>/admin_pengguna/destroy/<?= e($siswa['id_pengguna'])?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>  
        </table>
    </div>
</div>
