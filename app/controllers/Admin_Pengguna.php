<?php 

class Admin_Pengguna extends AdminController
{
    public function destroy($idPengguna)
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
            return redirect('admin_siswa');
        }

        return redirect('admin_petugas');
    }
}