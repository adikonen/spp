<?php 

class Admin_Petugas extends AdminController
{
    public function index()
    {
        $db = new Database();
        $all_petugas = $db->query('SELECT * FROM pengguna_petugas_view')->get();
        $data = ['all_petugas' => $all_petugas];
        return $this->render('admin/petugas/index', $data);
    }

    public function create()
    {
        return $this->render('admin/petugas/create');
    }

    public function edit($idPengguna)
    {
        $db = new Database;
        $petugas = $db->query('SELECT * FROM pengguna_petugas_view WHERE id_pengguna = :id_pengguna')
            ->bind(':id_pengguna', $idPengguna)
            ->firstOrFail("Petugas tidak ditemukan!");
            
        $data = ['petugas' => $petugas];
        
        return $this->render('admin/petugas/edit', $data);
    }

    public function store()
    {
        $db = new Database();
        $db->beginTransaction();

        try {
            $db->query('CALL storePengguna(:username, :password, :role)')
                ->bind(':username', $_POST['username'])
                ->bind(':password', $_POST['password'])
                ->bind(':role', PETUGAS_ROLE)
                ->execute();

            // $db->query('SELECT id_pengguna FROM pengguna WHERE username = :username AND password =:password')
            $pengguna = $db->query('CALL findPenggunaByUsernameAndPassword(:username, :password)')
                ->bind(':username', $_POST['username'])
                ->bind(':password', $_POST['password'])
                ->first();

            $idPengguna = $pengguna['id_pengguna'];

            $db->query('INSERT INTO petugas (nama_petugas, id_pengguna) VALUES (:nama_petugas, :id_pengguna)')
                ->bind(':nama_petugas', $_POST['nama_petugas'])
                ->bind(':id_pengguna', $idPengguna)
                ->execute();

        } catch (Exception $error) {
            logging_error('ERROR STORE PETUGAS, MESSAGE:'.$error->getMessage());
            $db->rollback();

            Flasher::set('danger', 'Gagal store petugas!');
            return redirect('admin_petugas');
        } 

        $db->commit();
        return redirect('admin/petugas');
    }

    public function update($idPengguna)
    {
        $db = new Database();
        $db->beginTransaction();

        try {
            $db->query('CALL updatePenggunaById(:username, :password, :role, :id_pengguna)')
                ->bind(':username', $_POST['username'])
                ->bind(':password', $_POST['password'])
                ->bind(':role', PETUGAS_ROLE)
                ->bind(':id_pengguna', $idPengguna)
                ->execute();

            $db->query('UPDATE petugas SET nama_petugas = :nama_petugas WHERE id_pengguna = :id_pengguna LIMIT 1')
                ->bind(':nama_petugas', $_POST['nama_petugas'])
                ->bind(':id_pengguna' ,$idPengguna)
                ->execute();

        } catch (Exception $error) {
            logging_error('ERROR UPDATE PETUGAS, MESSAGE:'.$error->getMessage());
            $db->rollback();
            Flasher::set('danger', 'Gagal mengupdate petugas!');
            return redirect('admin_petugas');
        }

        Flasher::set('success', 'Berhasil mengupdate petugas!');
        $db->commit();
        return redirect('admin_petugas');
    }
}