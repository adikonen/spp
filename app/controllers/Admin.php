<?php

class Admin extends AdminController
{

    /**
     * menampilkan halaman dashboard
     */
    public function index()
    {
        $db = new Database;

        $petugas = $db->query('SELECT * FROM petugas')->rowCount();
        $siswa = $db->query('SELECT * FROM siswa')->rowCount();
        $data = ['petugas' => $petugas, 'siswa' => $siswa];

        return $this->render('admin/index', $data);
    }

}