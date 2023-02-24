<?php 

class ReportHelper
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();    
    }

    public function countMonthlyEarning($tahunAjaran, $bulanDibayar)
    {
        $db = $this->db;

        return $db->query('SELECT SUM(nominal) FROM pembayaran_transaksi_siswa_view WHERE tahun_ajaran = :tahun_ajaran AND bulan_dibayar = :bulan_dibayar')
            ->bind(':tahun_ajaran',$tahunAjaran)
            ->bind(':bulan_dibayar',$bulanDibayar)
            ->flatFirst();
    }

    public function countAnnualEarning($tahunAjaran)
    {
        $db = $this->db;
        return $db->query('SELECT SUM(nominal) FROM pembayaran_transaksi_siswa_view WHERE tahun_ajaran = :tahun_ajaran')
            ->bind(':tahun_ajaran',$tahunAjaran)
            ->flatFirst();
    }

    public function countTransaction($tahunAjaran)
    {
        $db = $this->db;
        return $db->query('SELECT COUNT(*) FROM pembayaran_transaksi_siswa_view WHERE tahun_ajaran = :tahun_ajaran')
            ->bind(':tahun_ajaran',$tahunAjaran)
            ->flatFirst();
        
    }

  
}