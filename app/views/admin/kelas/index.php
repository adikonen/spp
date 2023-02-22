<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar kelas</h4>
        <a href="<?= BASE_URL?>/admin_kelas/create" class="btn btn-success text-capitalize">Tambah kelas</a>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar kelas dalam sistem</div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Kelas</th>
                        <th>Kompetensi Keahlian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>        
                <tbody>
                    <?php foreach($data['all_kelas'] as $kelas):?>
                    <tr>
                        <td><?= e($kelas['nama_kelas'])?></td>
                        <td><?= e($kelas['kompetensi_keahlian'])?></td>
                        <td>
                            <a href="<?= BASE_URL?>/admin_kelas/edit/<?= e($kelas['id_kelas'])?>" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL?>/admin_kelas/destroy/<?= e($kelas['id_kelas'])?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
