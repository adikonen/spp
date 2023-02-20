<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900">Daftar Petugas</h4>
        <a href="<?= BASE_URL?>/admin/petugas_create" class="btn btn-success">Tambah Petugas</a>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar petugas dalam sistem</div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>        
                <tbody>
                    <?php foreach($data['all_petugas'] as $petugas):?>
                    <tr>
                        <td><?= e($petugas['username'])?></td>
                        <td><?= e($petugas['nama_petugas'])?></td>
                        <td>
                            <a href="<?= BASE_URL?>/admin/petugas_edit/<?= e($petugas['id_pengguna'])?>" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL?>/admin/pengguna_destroy/<?= e($petugas['id_pengguna'])?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
<!-- 
<script>
    $('document').ready(function() {
        $('#dataTable').DataTable({
            ajax: {
                url: `<?= BASE_URL?>/admin/petugas_datatable`,
                dataSrc: ''
            },
            'processing':true,
            'serverSide':true,
            columns: [
                {data: 'username'},
                {data: 'nama_petugas'},
                {data: 'id_pengguna', render: function(id) {
                    return `
                        <td>
                            <a href="<?= BASE_URL?>/admin/petugas_edit/${id}" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL?>/admin/pengguna_destroy/${id}" class="btn btn-danger">Hapus</a>
                        </td>
                    `
                }}
            ],
        });
    });
</script> -->