<?php 

class Siswa extends Controller
{
    protected function render($view, $data = [])
    {
        parent::view('templates/siswa/header');
        parent::view($view, $data);
        parent::view('templates/siswa/footer');
    }

    public function index()
    {
        return $this->render('siswa/index');
    }

    public function history()
    {
        $db = new Database();
        $user = getLoginAccount();
        $all_transaksi = $db->query('SELECT * FROM pembayaran_transaksi_siswa_view WHERE id_pengguna = :id_pengguna')
            ->bind(':id_pengguna',$user['id_pengguna'])
            ->get();

        $data = ['all_transaksi' => $all_transaksi];

        return $this->render('siswa/history', $data);
    }
}