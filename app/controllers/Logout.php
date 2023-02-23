<?php 

class Logout extends Controller 
{
    public function index()
    {
        unset($_SESSION['user']);
        return redirect('login');
    }
}