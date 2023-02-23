<?php 

class Siswa 
{
    /**
     * memaksa user harus login sebagai siswa ketika mengakses url dengan
     * prefix /siswa
     */
    public function __construct()
    {
        Access::for(SISWA_ROLE);
    }

    public function index()
    {
        $user = getLoginAccount();
        $id = $user['id_siswa'];


        $all_transaksi = $this->model('Siswa_model')->history($id);
        $data = [
            'all_transaksi' => $all_transaksi
        ];

        $this->view('',$data);
    }

    
}