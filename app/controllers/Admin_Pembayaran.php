<?php 

class Admin_Pembayaran extends AdminController
{

    public function index()
    {
        $db = new Database();
        $all_pembayaran = $db->query('SELECT * FROM pembayaran')->get();
        $data = ['all_pembayaran' => $all_pembayaran];

        return $this->render('admin/pembayaran/index', $data);
    }

    public function create()
    {
        return $this->render('admin/pembayaran/create');
    }

    public function edit($idPembayaran)
    {
        $db = new Database();
        $pembayaran = $db->query('SELECT * FROM pembayaran WHERE id_pembayaran = :id_pembayaran')
            ->bind(':id_pembayaran', $idPembayaran)
            ->firstOrFail('Pembayaran tidak ditemukan!');

        $data = ['pembayaran' => $pembayaran];
        return $this->render('admin/pembayaran/edit', $data);
    }

    public function store()
    {
        $db = new Database();
        $db->query('INSERT INTO pembayaran (nominal, tahun_ajaran) VALUES (:nominal, :tahun_ajaran)')
            ->bind(':nominal', $_POST['nominal'])
            ->bind(':tahun_ajaran', $_POST['tahun_ajaran'])
            ->execute();

        Flasher::set('success','Berhasil membuat pembayaran!');
        return redirect('admin_pembayaran');
    }

    public function update($idPembayaran)
    {
        $db = new Database();
        $db->query('UPDATE pembayaran SET nominal = :nominal, tahun_ajaran = :tahun_ajaran WHERE id_pembayaran = :id_pembayaran')
            ->bind(':nominal', $_POST['nominal'])
            ->bind(':tahun_ajaran', $_POST['tahun_ajaran'])
            ->bind(':id_pembayaran', $idPembayaran)
            ->execute();
        
        Flasher::set('success', 'Berhasil mengupdate pembayaran!');
        return redirect('admin_pembayaran');
    }

    public function destroy($idPembayaran)
    {
        $db = new Database();
        try {
            $db->query('DELETE FROM pembayaran WHERE id_pembayaran = :id_pembayaran')
                ->bind(':id_pembayaran', $idPembayaran)
                ->execute();
        } catch (Exception $error) {
            logging_error('ERROR DELETE PEMBAYARAN, MESSAGE:'.$error->getMessage());
            Flasher::set('danger','Gagal menghapus pembayaran!');
            return redirect('admin_pembayaran');
        }
        Flasher::set('success', 'Berhasil menghapus pembayaran');
        return redirect('admin_pembayaran');
    }

}