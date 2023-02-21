<?php

class Admin extends Controller
{
    /**
     * memaksa user harus login saat ingin memasuki halaman dengan prefix admin
     */
    public function __construct()
    {
        // Access::loginRequired();
    }

    protected function render($view, $data = [])
    {
        $this->view('templates/admin/header');
        $this->view($view, $data);
        $this->view('templates/admin/footer');
    }
    /**
     * menampilkan halaman dashboard
     */
    public function index()
    {
        return $this->render('admin/index');
    }

    public function petugas()
    {
        $db = new Database();
        $all_petugas = $db->query('SELECT * FROM pengguna_petugas_view')->get();
        $data = ['all_petugas' => $all_petugas];
        return $this->render('admin/petugas/index', $data);
    }

    public function petugas_create()
    {
        return $this->render('admin/petugas/create');
    }

    public function petugas_edit($idPengguna)
    {
        $db = new Database;
        $petugas = $db->query('SELECT * FROM pengguna_petugas_view WHERE id_pengguna = :id_pengguna')
            ->bind(':id_pengguna', $idPengguna)
            ->firstOrFail("Petugas tidak ditemukan!");
            
        $data = ['petugas' => $petugas];
        
        return $this->render('admin/petugas/edit', $data);
    }

    public function petugas_store()
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
            return redirect('admin/petugas');
        } 

        $db->commit();
        return redirect('admin/petugas');
    }

    public function petugas_update($idPengguna)
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
            return redirect('admin/petugas');
        }

        $db->commit();
        return redirect('admin/petugas');
    }

    public function pengguna_destroy($idPengguna)
    {
        $db = new Database();
        $pengguna = $db->query('SELECT * FROM pengguna WHERE id_pengguna = :id_pengguna')
            ->bind(':id_pengguna',$idPengguna)
            ->first(); 
        try {
            $db->query('DELETE FROM pengguna WHERE id_pengguna = :id_pengguna')
                ->bind(':id_pengguna', $idPengguna)
                ->execute();
        } catch (Exception $error) {
            Flasher::set('danger', 'Gagal menghapus pengguna!');
            logging_error('ERROR DELETE PETUGAS, MESSAGE:'.$error->getMessage());
            return redirect('admin/petugas');
        }

        Flasher::set('success', 'Berhasil menghapus pengguna!');
        
        if ($pengguna['role'] === SISWA_ROLE) {
            return redirect('admin/siswa');
        }

        return redirect('admin/petugas');
    }

    public function kelas()
    {
        $db = new Database();
        $all_kelas = $db->query('SELECT * FROM kelas')->get();
        $data = ['all_kelas' => $all_kelas];

        return $this->render('admin/kelas/index', $data);
    }

    public function kelas_create()
    {
        return $this->render('admin/kelas/create');
    }

    
    public function kelas_edit($idKelas)
    {
        $db = new Database();
        $kelas = $db->query('SELECT * FROM kelas WHERE id_kelas = :id_kelas')
            ->bind(':id_kelas',$idKelas)
            ->firstOrFail('Gagal menemukan kelas!');

        $data = ['kelas' => $kelas];
        return $this->render('admin/kelas/edit', $data);
    }

    public function kelas_store()
    {
        $db = new Database();
        $db->query('INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES (:nama_kelas, :kompetensi_keahlian)')
            ->bind(':nama_kelas', $_POST['nama_kelas'])
            ->bind(':kompetensi_keahlian', $_POST['kompetensi_keahlian'])
            ->execute();
        
        Flasher::set('success', 'Berhasil membuat kelas!');
        return redirect('admin/kelas');
    }

    public function kelas_update($idKelas)
    {
        $db = new Database();
        $db->query('UPDATE kelas SET nama_kelas = :nama_kelas, kompetensi_keahlian = :kompetensi_keahlian WHERE id_kelas = :id_kelas')
            ->bind(':nama_kelas', $_POST['nama_kelas'])
            ->bind(':kompetensi_keahlian', $_POST['kompetensi_keahlian'])
            ->bind(':id_kelas', $idKelas)
            ->execute();

        Flasher::set('success', 'Berhasil mengupdate kelas!');
        return redirect('admin/kelas');
    }

    public function kelas_destroy($idKelas)
    {
        $db = new Database();
        try {
            $db->query('DELETE FROM kelas WHERE id_kelas = :id_kelas')
                ->bind(':id_kelas', $idKelas)
                ->execute();
        } catch (Exception $error) {
            logging_error('GAGAL MENGHAPUS KELAS, MESSAGE:'.$error->getMessage());
            Flasher::set('danger', 'Gagal menghapus kelas!');
            return redirect('admin/kelas');
        }

        Flasher::set('success', 'Berhasil menghapus kelas!');
        return redirect('admin/kelas');
    }

    public function pembayaran()
    {
        $db = new Database();
        $all_pembayaran = $db->query('SELECT * FROM pembayaran')->get();
        $data = ['all_pembayaran' => $all_pembayaran];

        return $this->render('admin/pembayaran/index', $data);
    }

    public function pembayaran_create()
    {
        return $this->render('admin/pembayaran/create');
    }

    public function pembayaran_edit($idPembayaran)
    {
        $db = new Database();
        $pembayaran = $db->query('SELECT * FROM pembayaran WHERE id_pembayaran = :id_pembayaran')
            ->bind(':id_pembayaran', $idPembayaran)
            ->firstOrFail('Pembayaran tidak ditemukan!');

        $data = ['pembayaran' => $pembayaran];
        return $this->render('admin/pembayaran/edit', $data);
    }

    public function pembayaran_store()
    {
        $db = new Database();
        $db->query('INSERT INTO pembayaran (nominal, tahun_ajaran) VALUES (:nominal, :tahun_ajaran)')
            ->bind(':nominal', $_POST['nominal'])
            ->bind(':tahun_ajaran', $_POST['tahun_ajaran'])
            ->execute();

        Flasher::set('success','Berhasil membuat pembayaran!');
        return redirect('admin/pembayaran');
    }

    public function pembayaran_update($idPembayaran)
    {
        $db = new Database();
        $db->query('UPDATE pembayaran SET nominal = :nominal, tahun_ajaran = :tahun_ajaran WHERE id_pembayaran = :id_pembayaran')
            ->bind(':nominal', $_POST['nominal'])
            ->bind(':tahun_ajaran', $_POST['tahun_ajaran'])
            ->bind(':id_pembayaran', $idPembayaran)
            ->execute();
        
        Flasher::set('success', 'Berhasil mengupdate pembayaran!');
        return redirect('admin/pembayaran');
    }

    public function pembayaran_destroy($idPembayaran)
    {
        $db = new Database();
        try {
            $db->query('DELETE FROM pembayaran WHERE id_pembayaran = :id_pembayaran')
                ->bind(':id_pembayaran', $idPembayaran)
                ->execute();
        } catch (Exception $error) {
            logging_error('ERROR DELETE PEMBAYARAN, MESSAGE:'.$error->getMessage());
            Flasher::set('danger','Gagal menghapus pembayaran!');
            return redirect('admin/pembayaran');
        }
        Flasher::set('success', 'Berhasil menghapus pembayaran');
        return redirect('admin/pembayaran');
    }

    public function siswa()
    {
        $db = new Database();
        $all_siswa = $db->query('SELECT * FROM siswa_kelas_view')->get();
        $data = ['all_siswa' => $all_siswa];

        return $this->render('admin/siswa/index',$data);
    }

    public function siswa_create()
    {
        $db = new Database();
        $all_kelas = $db->query('SELECT * FROM kelas')->get();
        $all_pembayaran = $db->query('SELECT * FROM pembayaran')->get();
        
        $data = [
            'all_kelas'      => $all_kelas,
            'all_pembayaran' => $all_pembayaran
        ];

        return $this->render('admin/siswa/create', $data);
    }

    public function siswa_edit($idPengguna)
    {
        $db = new Database();
        $siswa = $db->query('SELECT * FROM pengguna_siswa_view WHERE id_pengguna = :id_pengguna')
            ->bind(':id_pengguna', $idPengguna)
            ->firstOrFail('Gagal menemukan siswa!');
        
        $all_kelas = $db->query('SELECT * FROM kelas')->get();
        $all_pembayaran = $db->query('SELECT * FROM pembayaran')->get();

        $data = [
            'siswa'             => $siswa,
            'all_kelas'         => $all_kelas,
            'all_pembayaran'    => $all_pembayaran
        ];

        return $this->render('admin/siswa/edit',$data);
    }

    public function siswa_store()
    {
        $db = new Database();
        $db->beginTransaction();

        $username = $_POST['nis'];
        try {
            $db->query('CALL storePengguna(:username, :password,:role)')
                ->bind(':username', $username)
                ->bind(':password', $_POST['password'])
                ->bind(':role', SISWA_ROLE)
                ->execute();
            
            $pengguna = $db->query('CALL findPenggunaByUsernameAndPassword(:username,:password)')
                ->bind(':username',$username)
                ->bind(':password',$_POST['password'])
                ->first();

            $idPengguna = $pengguna['id_pengguna'];

            $insertQuery = 'INSERT INTO siswa (nis,nisn,nama,alamat,telepon,id_pengguna,id_kelas,id_pembayaran) VALUES(:nis,:nisn,:nama,:alamat,:telepon,:id_pengguna,:id_kelas,:id_pembayaran)';
            $db->query($insertQuery)
                ->bind(':nis', $_POST['nis'])
                ->bind(':nisn',$_POST['nisn'])
                ->bind(':nama',$_POST['nama'])
                ->bind(':alamat',$_POST['alamat'])
                ->bind(':telepon',$_POST['telepon'])
                ->bind(':id_kelas',$_POST['id_kelas'])
                ->bind(':id_pembayaran',$_POST['id_pembayaran'])
                ->bind(':id_pengguna',$idPengguna)
                ->execute();
        
        } catch (Exception $error) {
            logging_error('ERROR INSERT SISWA MESSAGE:'.$error->getMessage());
            $db->rollback();
            Flasher::set('danger','Gagal membuat siswa');
            return redirect('admin/siswa');
        }

        $db->commit();
        Flasher::set('success', 'Berhasil membuat siswa');
        return redirect('admin/siswa');
    }

    public function siswa_update($idPengguna)
    {
        $db = new Database();
        $db->beginTransaction();

        $username = $_POST['nis'];
        try {
            $db->query('CALL updatePenggunaById(:username, :password, :role, :id_pengguna)')
                ->bind(':username', $username)
                ->bind(':password', $_POST['password'])
                ->bind(':role', SISWA_ROLE)
                ->bind(':id_pengguna', $idPengguna)
                ->execute();

            $updateQuery = 'UPDATE siswa SET
                nama = :nama,
                nis = :nis,
                nisn = :nisn,
                alamat = :alamat,
                telepon = :telepon,
                id_kelas = :id_kelas,
                id_pembayaran = :id_pembayaran 
                WHERE id_pengguna = :id_pengguna
            ';

            $count = $db->query($updateQuery)
                ->bind(':nama', $_POST['nama'])
                ->bind(':nis', $_POST['nis'])
                ->bind(':nisn', $_POST['nisn'])
                ->bind(':alamat',$_POST['alamat'])
                ->bind(':telepon',$_POST['telepon'])
                ->bind(':id_kelas', $_POST['id_kelas'])
                ->bind(':id_pembayaran',$_POST['id_pembayaran'])
                ->bind(':id_pengguna' ,$idPengguna)
                ->rowCount();

        } catch (Exception $error) {
            logging_error('ERROR UPDATE SISWA, MESSAGE:'.$error->getMessage());
            $db->rollback();
            Flasher::set('danger', 'Gagal mengupdate siswa!');
            return redirect('admin/siswa');
        }

        $db->commit();
        Flasher::set('success','Berhasil mengupdate siswa!');
        return redirect('admin/siswa');
    }

    public function transaksi()
    {

    }
}