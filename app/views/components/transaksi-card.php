<?php 
$all_month = $data['all_month'];
$siswa = $data['siswa'];
$tahun = $data['tahun'];
?>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($all_month['unpaid'] as $month_num => $month_name):?>
                <tr>
                    <td><?= e($month_name)?></td>
                    <td>
                        <form action="<?= BASE_URL?>/admin_transaksi/lunas/<?= e($siswa['id_siswa'])?>" class="d-inline" method="POST">
                            <input type="hidden" name="bulan" value="<?= e($month_num)?>">
                            <input type="hidden" name="tahun" value="<?= e($tahun)?>">
                            <button class="btn btn-primary">Lunaskan</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>