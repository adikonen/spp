<?php 
$siswa = $data['siswa'];
$all_month = $data['all_month'];
$all_tahun = $data['all_tahun'];
?>
<div class="d-flex justify-content-between my-2">
  <h4>Entry Transaksi</h4>
  <button class="btn btn-warning">History Transaksi</button>
</div>

<div class="card">
  <div class="card-header text-primary">
    <?= e($siswa['nis'] . ' - ' . $siswa['nama'])?>
  </div>
  <div class="card-body">
  <div class="alert alert-primary">
  Siswa Angkatan <?= e($siswa['angkatan'])?>
  </div>
  <div class="mb-3">
    <?php foreach($all_month['has_paid'] as $month_name):?>
      <div class="badge btn-success p-2"><?= e($month_name)?></div>
    <?php endforeach;?>
  </div>
  <nav>
    <div class="nav nav-tabs mb-2" id="nav-tab" role="tablist">

      <ul class="nav nav-tabs">
        <?php foreach($all_tahun as $tahun => $isActive):?>
        <li class="nav-item">
          <a class="nav-link <?php if($tahun == $data['tahun_ajaran']):?>active<?php endif?>" href="<?= BASE_URL?>/admin_transaksi/show/<?= e($siswa['id_siswa'])?>/<?= e($tahun)?>"><?= e($tahun)?></a>
        </li>
        <?php endforeach;?>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">2021</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2022</a>
        </li> -->
      </ul>

    </div>
  </nav>
  <div class="card">
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
            <form action="<?= BASE_URL?>/admin_transaksi/store/<?= e($siswa['id_siswa'])?>/<?= e($data['tahun_ajaran'])?>" method="post">
              <input type="hidden" name="bulan" value="<?= e($month_num)?>">
              <button type="submit" onclick="return confirm('Yakin??')" class="btn btn-primary">Lunaskan</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  
</div>
