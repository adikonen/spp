<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar siswa</h4>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar siswa dalam sistem</div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>        
                <tbody>
                    <?php foreach($data['all_siswa'] as $siswa):?>
                    <tr>
                        <td><?= $siswa['nis']?></td>
                        <td><?= $siswa['nama']?></td>
                        <td><?= $siswa['telepon']?></td>
                        <td>
                            <a href="<?= BASE_URL?>/admin_transaksi_v2/bayar/<?= $siswa['id_siswa']?>" class="btn btn-warning">Entry</a>
                            <a href="<?= BASE_URL?>/admin_transaksi_v2/history/<?= $siswa['id_siswa']?>" class="btn btn-secondary">History</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
