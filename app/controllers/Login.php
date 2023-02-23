<?php 

class Login extends Controller
{
    public function __construct()
    {
        guest_only();
    }

    public function index()
    {
        $this->view('login');
    }

    public function store()
    {
        $db = new Database();
        $user = $db->query('CALL findPenggunaByUsernameAndPassword(:username,:password)')
            ->bind(':username',$_POST['username'])
            ->bind(':password',$_POST['password'])
            ->first();
         
        if ($user == null) {
            Flasher::set('danger','Username atau Password tidak cocok.');
            return redirect('login');
        }

        if ($user['role'] === SISWA_ROLE) {
            $siswa = $db->query('SELECT nama FROM siswa WHERE id_pengguna = :id_pengguna')
                ->bind(':id_pengguna', $user['id_pengguna'])
                ->first();

            $user['nama'] = $siswa['nama'];
        }

        login($user);
        return redirect('redirector/index');
    }

}