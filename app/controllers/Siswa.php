<?php 

class Siswa 
{
    /**
     * memaksa user harus login sebagai siswa ketika mengakses url dengan
     * prefix /siswa
     */
    public function __construct()
    {
        Access::for(SISWA_ROLE);
    }

    
}