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

function getMonthOption($month_num = null)
{
    $month = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    if ($month_num === null) {
        return $month;
    }

    return $month[$month_num];
}

function getBulanOptionFromJuly()
{
    return [
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
    ];
}



function redirect($path)
{
    $path = BASE_URL .'/'. trim($path,'/');
    header("Location: $path");
    die;
}

/**
 * @param array $data
 * @return void
 */
function login($data) 
{
    //username
    //password
    //role
    //dll
    if (isset($data['password'])) {
        unset($data['password']);
    }

    $_SESSION['user'] = $data;
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
        return redirect('redirector/index');
    }
}

function staff_only()
{
    $user = getLoginAccount();

    login_required();
    if ($user['role'] === SISWA_ROLE) {
        return redirect('redirector/index');
    }
}

function admin_only()
{
    $user = getLoginAccount();
    staff_only();

    if ($user['role'] === PETUGAS_ROLE) {
        return redirect('redirector/index');
    }
}

function siswa_only()
{
    $user = getLoginAccount();

    if ($user['role'] !== SISWA_ROLE) {
        return redirect('redirector/index');
    }
    
}

function guest_only()
{
    $user = getLoginAccount();
    
    if ($user != null) {
        return redirect('redirector/index');
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