<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(APP_NAME)?> | Laporan Tahun <?= e($data['tahun'])?></title>
    <link rel="stylesheet" href="<?= BASE_URL?>/css/sb-admin-2.min.css">
</head>
<body class="">
    <div class="text-center mb-4">
        <h2>Laporan Keuangan Tahun <?= e($data['tahun'])?></h2>
        <h4>Jumlah Transaksi Telah dilakukan : <?= e($data['count_transaction'])?></h4>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>Bulan</th>
                    <th>Pemasukan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['all_month'] as $month_num => $month_earning):?>
                <tr class="text-center">
                    <td><?= e(getMonthOption($month_num))?></td>             
                    <td><?= e($month_earning)?></td>   
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end align-content-center p-3">
        <h6 class="mt-1 mx-3">Pemasukan Tahunan : </h6>
        <h4><?= e($data['annual_earning'])?></h4>
    </div>
</body>
</html>

<script>
    document.onload(window.print())
</script>