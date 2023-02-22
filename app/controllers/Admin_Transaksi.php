<?php 

class Admin_Transaksi extends AdminController
{
    public function index()
    {
        $db = new Database();
        $all_siswa = $db->query('SELECT * FROM siswa_kelas_view')->get();
        $all_kelas = $db->query('SELECT * FROM kelas')->get();
        $all_bulan = getBulanOption();
        
        $data = [
            'all_siswa' => $all_siswa,
            'all_kelas' => $all_kelas,
            'all_bulan' => $all_bulan
        ];

        return $this->render('admin/transaksi/index', $data);
    }

    public function filter($kelas = null)
    {

    }
}