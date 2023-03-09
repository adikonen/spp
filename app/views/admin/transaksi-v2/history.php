<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar transaksi</h4>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar history transaksi dalam sistem</div>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Tanggal Dibayar</th>
                    </tr>
                </thead>        
                <tbody>
                    <?php foreach($data['all_transaksi'] as $transaksi):?>
                        <tr>
                            <td><?= e(getMonthOption($transaksi['bulan_dibayar']))?></td>
                            <td><?= e($transaksi['tahun_dibayar']);?></td>
                            <td><?= e($transaksi['tanggal_bayar'])?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
