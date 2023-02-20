<?php

function getLoginAccount()
{
    if (!isset($_SESSION['user'])) {
        return null;
    }

    return $_SESSION['user'];
}

function dd($var) 
{
    var_dump($var);
    die;
}

function redirect($path)
{
    $path = BASE_URL .'/'. trim($path,'/');
    header("Location: $path");
    die;
}

/**
 * @param int $level
 * @return string|null
 */
function getRoleName($level)
{
    if ($level < 1 || $level > 3 || $level == null) {
        return null;
    }

    $roles = [
        '1' => 'admin',
        '2' => 'petugas',
        '3' => 'siswa'
    ];

    return $roles[$level];
}

function login_required()
{
    $user = getLoginAccount();

    if ($user == null) {
        return redirect('login');
    }
}

function e($str) 
{
    if ($str == null) {
        return null;
    } 

    return htmlspecialchars($str);
}

function logging_error(string $content)
{
    return file_put_contents(ERROR_LOG_PATH, "$content\n" ,FILE_APPEND);
}