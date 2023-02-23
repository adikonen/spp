<?php 

class Redirector extends Controller
{
    public function index()
    {
        $user = getLoginAccount();

        if ($user == null) {
            Flasher::set('danger', 'Mohon Login terlebih dahulu!');
            return redirect('login');
        } 

        $role = $user['role'];

        if ($role === SISWA_ROLE) {
            return redirect('siswa');
        }
        
        return redirect('admin');
    }
}
