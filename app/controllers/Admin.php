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
        try {
            $db->query('DELETE FROM pengguna WHERE id_pengguna = :id_pengguna')
                ->bind(':id_pengguna', $idPengguna)
                ->execute();
        } catch (Exception $error) {
            Flasher::set('danger', 'Gagal menghapus petugas!');
            logging_error('ERROR DELETE PETUGAS, MESSAGE:'.$error->getMessage());
            return redirect('admin/petugas');
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
        
        Flasher::set('danger', 'Berhasil membuat kelas!');
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
        return $this->render('admin/petugas/edit', $data);
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
    
    /**
     * menampilkan history transaksi
     */
    public function transaksi($transaksi_filter_type = null, $filter_value = null)
    {
        $db = new Database();
        $query = 'SELECT * FROM pembayaran_transaksi_siswa_view';

        if ($transaksi_filter_type != null) {
            // $transaksi_filter_type bisa saja berisi nilai bahaya oleh karena itu harus dicek
            if (! TransaksiHelper::isFilterTypeAllowed($transaksi_filter_type)) {
                dd([$transaksi_filter_type, $filter_value]);
            } 
            $query .= " WHERE $transaksi_filter_type = :filter_value";
        }  

        $all_transaksi = $db->query($query)
            ->when($transaksi_filter_type != null, fn(Database $db) => $db->bind(':filter_value', $filter_value))
            ->get();

        $data = ['all_transaksi' => $all_transaksi];

        $this->view('templates/header');
        $this->view('admin/transaksi/index', $data);
        $this->view('templates/footer');
    }

    public function transaksi_create()
    {
        $db = new Database();
        $data = TransaksiHelper::getReferenceData($db);
        
        $this->view('templates/header');
        $this->view('admin/transaksi/entry', $data);
        $this->view('templates/footer');
    }

    public function transaksi_store()
    {
        $db = new Database();
        $db->query('CALL storeTransaksi(:)');

        
    }
}