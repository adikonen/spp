<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar siswa</h4>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah data siswa dalam sistem</div>
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
<<<<<<< HEAD
                          <a href="<?= BASE_URL?>/admin_transaksi/show/<?= e($siswa['id_siswa'])?>/<?= e($siswa['angkatan'])?>" class="btn btn-success">Entry Transaksi</a>
=======
                          <a href="<?= BASE_URL?>/admin_transaksi/show/<?= e($siswa['id_siswa'])?>/<?= e($siswa['angkatan'])?>" class="btn btn-success">Entry   </a>
                          <a href="<?= BASE_URL?>/admin_transaksi/history/<?= e($siswa['id_siswa'])?>" class="btn btn-warning">History</a>
>>>>>>> 4a1e8812b35b96fa2dbab751c73955a7fbe21bc5
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>

</div>
