<?php

class Controller 
{
    /**
     * melakukan render halaman pada folder views
     * 
     * @param string $view
     * @param array $data
     */
    public function view($view, $data = []) 
    {
        require_once "../app/views/$view.php";
    }

}
