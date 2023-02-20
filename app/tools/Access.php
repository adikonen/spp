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
            return redirectToRedirector();
        }
    }

    public static function forGuest()
    {
        $user = getLoginAccount();
        if ($user != null) {
            return redirectToRedirector();
        }
    }

    public static function loginRequired()
    {
        $user = getLoginAccount();
        if ($user == null) {
            return redirectToRedirector();
        }   
    }
}