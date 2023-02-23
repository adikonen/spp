<?php $siswa = $data['siswa'];?>

<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar transaksi</h4>
        <a href="<?= BASE_URL?>/admin_transaksi/show/" class="btn btn-success text-capitalize">Entry Transaksi</a>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar history transaksi dalam sistem</div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nis</th>
                        <th>Kelas</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>        
                <tbody>
                    <?php foreach($data['all_transaksi'] as $transaksi):?>
                    <tr>
                        <td><?= e($transaksi[''])?></td>
                        <td><?= e($transaksi['kompetensi_keahlian'])?></td>
                        <td>
                            <a href="<?= BASE_URL?>/admin_transaksi/edit/<?= e($transaksi['id_transaksi'])?>" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL?>/admin_transaksi/destroy/<?= e($transaksi['id_transaksi'])?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
