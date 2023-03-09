<?php 
$tahun_ajaran = $data['pembayaran']['tahun_ajaran'];
$id_siswa = $data['siswa']['id_siswa'];
$id_pembayaran = $data['pembayaran']['id_pembayaran'];
$siswa = $data['siswa'];
$pembayaran = $data['pembayaran'];
?>
<div>
    <div class="mb-2 d-flex justify-content-between">
        <h4>Entry Transaksi</h4>
        <a href="<?= BASE_URL?>/admin_transaksi_v2/history/<?= $id_siswa?>" class="btn btn-secondary">History</a>
    </div>
    <div class="alert alert-primary">
        Nominal pembayaran untuk tiap bulannya adalah <?= $pembayaran['nominal']?>
    </div>
    <div class="p-3 row">
        <?php foreach ($data['select_month'] as $month):?>
            <form class="col-3" action="<?= BASE_URL?>/admin_transaksi_v2/store/<?= $tahun_ajaran?>/<?= $month['month_num']?>/<?= $id_siswa?>/<?= $id_pembayaran?>" method="post">
                <div class="card mb-3 p-3 d-flex justify-content-between">
                    <p>
                        <?= $month['month_name']?>
                    </p>

                    <button class="btn btn-success" <?php if($month['has_paid']) :?> disabled <?php endif;?>>
                        <?php if ($month['has_paid']):?>
                            Telah Lunas
                        <?php else:?>
                            Lunaskan
                        <?php endif;?>
                    </button>
                </div>
            </form>
            <?php endforeach;?>
    </div>
</div>