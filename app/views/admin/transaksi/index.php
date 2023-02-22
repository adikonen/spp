<div>
    <div class="p-3 d-flex justify-content-between">
        <h4 class="text-gray-900 text-capitalize">Daftar siswa</h4>
        <a href="<?= BASE_URL?>/admin_siswa/create" class="btn btn-success text-capitalize">Tambah siswa</a>
    </div>
    <form class="card p-3 mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="bulan" id="bulan" class="form-control">
                    <option value="" disabled selected>Pilih Bulan</option>
                    <?php foreach($data['all_bulan'] as $nomor_bulan => $nama_bulan):?>
                        <option value="<?= e($nomor_bulan)?>"><?= e($nama_bulan)?></option> 
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="kelas" id="kelas" class="form-control">
                    <option value="" disabled selected>Pilih kelas</option>
                    <?php foreach($data['all_kelas'] as $kelas):?>
                        <option value="<?= e($kelas['id_kelas'])?>"><?= e($kelas['nama_kelas'])?></option> 
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="tahun" id="tahun" placeholder="Masukan Tahun" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <div class="alert alert-primary">
        Mohon Gunakan Filter untuk Menampilkan tabel
    </div>

    <!-- <div class="card p-3">
        <div class="table-responsive">
            <div class="alert alert-primary">Berikut adalah daftar siswa dalam sistem</div>
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
                            <a href="<?= BASE_URL?>/admin_siswa/edit/<?= e($siswa['id_pengguna'])?>" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL?>/admin_pengguna/destroy/<?= e($siswa['id_pengguna'])?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>  
            </table>
        </div>
    </div> -->
</div>
