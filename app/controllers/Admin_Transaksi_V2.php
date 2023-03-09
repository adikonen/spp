<?php

class Admin_Transaksi_V2 extends AdminController
{
    public function index()
    {
        $db = new Database();
        $all_siswa = $db->query('SELECT * FROM siswa')->get();

        $data = ['all_siswa' => $all_siswa];
        return $this->render('admin/transaksi-v2/index',$data);
    }

    /**
     * menampilkan formulir pembuatan transaksi
     */
    public function bayar($id_siswa)
    {
        $user = getLoginAccount();
        $db = new Database();
        $query_pembayaran = 'SELECT pembayaran.* FROM pembayaran 
            INNER JOIN siswa ON siswa.id_pembayaran = pembayaran.id_pembayaran 
            WHERE siswa.id_siswa = :id_siswa';

        $pembayaran = $db->query($query_pembayaran)->bind(':id_siswa',$id_siswa)->first();
        $siswa = $db->query('SELECT * FROM siswa WHERE id_siswa = :id')->bind(':id',$id_siswa)->first();
        
        $query_transaksi = 'SELECT bulan_dibayar FROM transaksi INNER JOIN siswa
            ON siswa.id_siswa = transaksi.id_siswa
            INNER JOIN pembayaran ON siswa.id_pembayaran = pembayaran.id_pembayaran
            WHERE tahun_ajaran = :tahun_ajaran AND siswa.id_siswa = :id
        ';

        $all_month = [7,8,9,10,11,12,1,2,3,4,5,6];
        $all_transaksi = $db->query($query_transaksi)
            ->bind(':tahun_ajaran',$pembayaran['tahun_ajaran'])
            ->bind(':id',$id_siswa)
            ->flat();
        
        $select_month = [];
        foreach ($all_month as $month_num) {
            $arr = ['month_num' => $month_num, 'month_name' => getMonthOption($month_num)];
            if (in_array($month_num, $all_transaksi)) {
                $arr['has_paid'] = true;
            } else {
                $arr['has_paid'] = false;
            }
            $select_month[] = $arr;
        }

        $data = [
            'pembayaran' => $pembayaran,
            'siswa' => $siswa,
            'select_month' => $select_month
        ];

        return $this->render('admin/transaksi-v2/bayar', $data);
    }

    public function store($tahun, $month_num, $id_siswa, $id_pembayaran)
    {
        $user = getLoginAccount();
        $db = new Database();
        $query_petugas = 'SELECT * FROM petugas WHERE id_pengguna = :id';
        $petugas = $db->query($query_petugas)->bind(':id', $user['id_pengguna'])->first();
 
        // coba date('Y-m-d H:i:s)
        $now = date('Y-m-d');

        $db->query('INSERT INTO transaksi 
            (tanggal_bayar, bulan_dibayar, tahun_dibayar,id_siswa,id_petugas,id_pembayaran)
            VALUES (:tanggal_bayar, :bulan_dibayar, :tahun_dibayar, :id_siswa, :id_petugas, :id_pembayaran)
        ')->bind(':tanggal_bayar',$now)
            ->bind(':bulan_dibayar', $month_num)
            ->bind(':tahun_dibayar',$tahun)
            ->bind(':id_siswa',$id_siswa)
            ->bind(':id_petugas',$petugas['id_petugas'])
            ->bind(':id_pembayaran',$id_pembayaran)
            ->execute();

        Flasher::set('success','Berhasil membuat transaksi');
        return redirect("admin_transaksi_v2/bayar/$id_siswa");
    }

    public function history($id_siswa)
    {
        $db = new Database();
        $all_transaksi = $db->query('SELECT * FROM transaksi WHERE id_siswa = :id_siswa ORDER BY tanggal_bayar')
            ->bind(':id_siswa',$id_siswa)
            ->get();
        
        $data = [
            'all_transaksi' => $all_transaksi,
        ];

        return $this->render("admin/transaksi-v2/history",$data);
    }
}