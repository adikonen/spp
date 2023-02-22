<?php 

class Access 
{
    public static function for(...$roles)
    {
        $user = getLoginAccount();
        $isForbidden = true;

        foreach ($roles as $role) {
            if ($user['role'] === $role) {
                $isForbidden = false;
                break;
            }
        } 
        
        if ($isForbidden) {
            return redirect('redirector/index');
        }
    }

    public static function forGuest()
    {
        $user = getLoginAccount();
        if ($user != null) {
            return redirect('redirector/index');
        }
    }

    public static function loginRequired()
    {
        $user = getLoginAccount();
        if ($user == null) {
            return redirect('redirector/index');
        }   
    }
}