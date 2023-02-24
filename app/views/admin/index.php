<?php $petugas = $data['petugas'];
      $siswa = $data['siswa'];
?>

<div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <button href="#" id="btn-report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Petugas</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= e($petugas)?></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= e($siswa)?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= e($siswa + $petugas)?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
            <video width="1080" height="760" autoplay>
                <source src="<?= BASE_URL?>/video/bumi.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            </div>
        </div>

<script>
    document.getElementById('btn-report').addEventListener('click',function() {
        const tahun = prompt('masukan tahun');
        if (tahun !== null) {
            window.location.href = `<?= BASE_URL?>/admin/laporan/${tahun}`;
        }
    });
</script>