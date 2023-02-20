<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar pembayaran</h4>
        <a href="<?= BASE_URL?>/admin/pembayaran_create" class="btn btn-success text-capitalize">Tambah pembayaran</a>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar pembayaran dalam sistem</div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nominal</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>        
                <tbody>
                    <?php foreach($data['all_pembayaran'] as $pembayaran):?>
                    <tr>
                        <td><?= e($pembayaran['nominal'])?></td>
                        <td><?= e($pembayaran['tahun_ajaran'])?></td>
                        <td>
                            <a href="<?= BASE_URL?>/admin/pembayaran_edit/<?= e($pembayaran['id_pembayaran'])?>" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL?>/admin/pembayaran_destroy/<?= e($pembayaran['id_pembayaran'])?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
