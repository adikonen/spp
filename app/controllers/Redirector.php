<?php 

class Redirector extends Controller
{
    public function index()
    {
        $user = getLoginAccount();

        if ($user == null) {
            echo 'guest';
            die;
        } 

        $level = $user['level'];
        if ($level == 1) {
            echo 'admin';
        } 
    }
}