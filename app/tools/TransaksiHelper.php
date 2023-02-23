<?php 

class TransaksiHelper 
{
    protected $db;
    protected $idSiswa;

    public function __construct($idSiswa)
    {
        $this->db = new Database(); 
        $this->idSiswa = $idSiswa;   
    }

    public function getAllMonthTransaction($tahunAjaran)
    {
        $db = $this->db;
        $idSiswa = $this->idSiswa;
        $query =  'SELECT bulan_dibayar FROM transaksi 
            WHERE id_siswa = :id_siswa AND id_pembayaran = (
            SELECT id_pembayaran FROM pembayaran WHERE tahun_ajaran = :tahun_ajaran
        )';

        $all_transaksi = $db->query($query)
            ->bind(':id_siswa',$idSiswa)
            ->bind(':tahun_ajaran', $tahunAjaran)
            ->flat(); 
        
        $all_month = getMonthOption();

        $hasPaid = [];
        $unpaid = [];

        foreach ($all_month as $k => $v) {
            if (! in_array($k,$all_transaksi)) {
                $unpaid[$k] = $v;
            } else {
                $hasPaid[$k] = $v;
            }
        }

        return [
            'has_paid' => $hasPaid,
            'unpaid' => $unpaid
        ];        
    }

    public function getActiveTahunAjaran()
    {
        $db = $this->db;
        $idSiswa = $this->idSiswa;

        $query = 'SELECT tahun_ajaran FROM pembayaran WHERE id_pembayaran = (
            SELECT id_pembayaran FROM siswa WHERE id_siswa = :id_siswa
        )';

        $active_tahun = $db->query($query)->bind(':id_siswa',$idSiswa)->flatFirst();
        return $active_tahun;
    }

    public function getYearSPP()
    {
        $db = $this->db;

        $idSiswa = $this->idSiswa;
        $active = $this->getActiveTahunAjaran($idSiswa);
        $angkatan = $db->query('SELECT angkatan FROM siswa WHERE id_siswa = :id_siswa')
            ->bind(':id_siswa',$idSiswa)
            ->flatFirst();

        $diffrent = $active - $angkatan;
        
        if ($diffrent === 0) {
            return [
                $active => true,
                $active + 1 => false,
                $active + 2 => false,
            ];
        }

        if ($diffrent === 1) {
            return [
                $active - 1 => false, 
                $active => true,
                $active + 1 => false,
            ];
        }

        return [
            $active - 2 => false, 
            $active - 1 => false,
            $active => true
        ];
    }

    public function getNextIdPembayaran($tahunAjaran)
    {
        $db = $this->db;

        return $db->query('SELECT id_pembayaran FROM pembayaran WHERE tahun_ajaran = :tahun_ajaran')
            ->bind(':tahun_ajaran',$tahunAjaran+1)
            ->flatFirst();
    }

   
}
