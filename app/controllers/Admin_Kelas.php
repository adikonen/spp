<?php 

class Admin_Kelas extends AdminController 
{
    public function index()
    {
        $db = new Database();
        $all_kelas = $db->query('SELECT * FROM kelas')->get();
        $data = ['all_kelas' => $all_kelas];

        return $this->render('admin/kelas/index', $data);
    }

    public function create()
    {
        return $this->render('admin/kelas/create');
    }

    
    public function edit($idKelas)
    {
        $db = new Database();
        $kelas = $db->query('SELECT * FROM kelas WHERE id_kelas = :id_kelas')
            ->bind(':id_kelas',$idKelas)
            ->firstOrFail('Gagal menemukan kelas!');

        $data = ['kelas' => $kelas];
        return $this->render('admin/kelas/edit', $data);
    }

    public function store()
    {
        $db = new Database();
        $db->query('INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES (:nama_kelas, :kompetensi_keahlian)')
            ->bind(':nama_kelas', $_POST['nama_kelas'])
            ->bind(':kompetensi_keahlian', $_POST['kompetensi_keahlian'])
            ->execute();
        
        Flasher::set('success', 'Berhasil membuat kelas!');
        return redirect('admin_kelas');
    }

    public function update($idKelas)
    {
        $db = new Database();
        $db->query('UPDATE kelas SET nama_kelas = :nama_kelas, kompetensi_keahlian = :kompetensi_keahlian WHERE id_kelas = :id_kelas')
            ->bind(':nama_kelas', $_POST['nama_kelas'])
            ->bind(':kompetensi_keahlian', $_POST['kompetensi_keahlian'])
            ->bind(':id_kelas', $idKelas)
            ->execute();

        Flasher::set('success', 'Berhasil mengupdate kelas!');
        return redirect('admin_kelas');
    }

    public function destroy($idKelas)
    {
        $db = new Database();
        try {
            $db->query('DELETE FROM kelas WHERE id_kelas = :id_kelas')
                ->bind(':id_kelas', $idKelas)
                ->execute();
        } catch (Exception $error) {
            logging_error('GAGAL MENGHAPUS KELAS, MESSAGE:'.$error->getMessage());
            Flasher::set('danger', 'Gagal menghapus kelas!');
            return redirect('admin_kelas');
        }

        Flasher::set('success', 'Berhasil menghapus kelas!');
        return redirect('admin_kelas');
    }
}