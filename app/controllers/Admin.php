<?php

class Admin extends AdminController
{

    /**
     * menampilkan halaman dashboard
     */
    public function index()
    {
        return $this->render('admin/index');
    }

}