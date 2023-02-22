<?php $siswa = $data['siswa'];?>
<div>
    <div class="d-flex mb-2">
        <h4>Edit Siswa</h4>
    </div>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_siswa/update/<?= e($siswa['id_pengguna'])?>" method="post">
           <?php include('_inputs.php');?>
        </form>
    </div>
</div>
