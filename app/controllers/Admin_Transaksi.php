<?php 

class Admin_Transaksi extends AdminController
{
    public function index()
    {
        $db = new Database();
        $all_siswa = $db->query('SELECT * FROM siswa_kelas_view')->get();
        $all_kelas = $db->query('SELECT * FROM kelas')->get();
        $all_bulan = getMonthOption();
                                                                                                        
        $data = [
            'all_siswa' => $all_siswa,
            'all_kelas' => $all_kelas,
            'all_bulan' => $all_bulan
        ];

        return $this->render('admin/transaksi/index', $data);
    }

    public function show($idSiswa, $tahunAjaran)
    {
        $db = new Database();
        $siswa = $db->query('SELECT * FROM siswa WHERE id_siswa = :id_siswa')
            ->bind(':id_siswa',$idSiswa)
            ->firstOrFail('Siswa Tidak ditemukan!');

        $transaksiHelper = new TransaksiHelper($siswa['id_siswa']);
        $all_tahun = $transaksiHelper->getYearSPP();
        
        if (! in_array($tahunAjaran, array_keys($all_tahun))) {
            Flasher::set('danger','tahun yang diberikan terlalu rendah atau tinggi!');
            return redirect('redirector/index');
        }

        $all_month = $transaksiHelper->getAllMonthTransaction($tahunAjaran);

        $data = [
            'siswa' => $siswa,
            'all_tahun' => $all_tahun,
            'all_month' => $all_month,
            'tahun_ajaran' => $tahunAjaran
        ];

        return $this->render('admin/transaksi/show',$data);
    }

    public function history($idSiswa)
    {
        $db = new Database();
        $siswa = $db->query('SELECT * FROM siswa WHERE id_siswa = :id_siswa')
            ->bind(':id_siswa',$idSiswa)
            ->firstOrFail('Gagal menemukan siswa!');

        $all_transaksi = $db->query('SELECT * FROM transaksi WHERE id_siswa = :id_siswa ORDER BY tanggal_bayar')
            ->bind(':id_siswa',$idSiswa)
            ->get();
        
        $data = [
            'all_transaksi' => $all_transaksi,
            'siswa' => $siswa
        ];

        return $this->render("admin/transaksi/history",$data);
    }

    public function store($idSiswa, $tahun)
    {
        $db = new Database();
        $transaksiHelper = new TransaksiHelper($idSiswa);
        $user = getLoginAccount();

        $siswa = $db->query('SELECT * FROM siswa WHERE id_siswa = :id_siswa')
            ->bind(':id_siswa',$idSiswa)
            ->first();

        $idPembayaran = $db->query('SELECT id_pembayaran FROM pembayaran WHERE tahun_ajaran = :tahun_ajaran')
            ->bind(':tahun_ajaran',$tahun)
            ->flatFirst();

        if ($siswa['id_pembayaran'] != $idPembayaran) {
            Flasher::set('danger','Mohon lunaskan spp tahun sebelumnya terlebih dahulu.');
            return redirect("admin_transaksi/show/$idSiswa/$tahun");
        }

        $idPetugas = $db->query('SELECT * FROM petugas WHERE id_pengguna = :id_pengguna')
            ->bind(':id_pengguna', $user['id_pengguna'])
            ->flatFirst();

        $db->query('INSERT INTO transaksi (tanggal_bayar,bulan_dibayar,tahun_dibayar,id_petugas,id_siswa,id_pembayaran)
            VALUES (:tanggal_bayar,:bulan_dibayar,:tahun_dibayar,:id_petugas, :id_siswa, :id_pembayaran)    
        ')
        ->bind(':tanggal_bayar',date('Y-m-d'))
        ->bind(':bulan_dibayar', $_POST['bulan'])
        ->bind(':tahun_dibayar',$tahun)
        ->bind(':id_petugas', $idPetugas)
        ->bind(':id_siswa',$idSiswa)
        ->bind(':id_pembayaran', $idPembayaran)
        ->execute();

        $count = $db->query('SELECT COUNT(id_siswa) FROM transaksi WHERE id_siswa = :id_siswa AND id_pembayaran = :id_pembayaran')
            ->bind(':id_siswa',$idSiswa)
            ->bind(':id_pembayaran',$idPembayaran)
            ->flatFirst();

        Flasher::set('success','berhasil melunasi pembayaran!');

        if ($count >= 12) {
            $nextIdPembayaran = $transaksiHelper->getNextIdPembayaran($tahun);
            $db->query('UPDATE siswa SET id_pembayaran = :id_pembayaran WHERE id_siswa = :id_siswa')
                ->bind(':id_siswa',$idSiswa)
                ->bind(':id_pembayaran',$nextIdPembayaran)
                ->execute();

            Flasher::set('success',"Siswa ini sudah melunasi semua spp di tahun $tahun");
        }

        return redirect("admin_transaksi/show/$idSiswa/$tahun");
    }

}