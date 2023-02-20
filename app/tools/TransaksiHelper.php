<?php 

class TransaksiHelper 
{
    protected static $filter_types_allowed = [
        'nis', 
        'bulan_dibayar', 
        'tahun_dibayar'
    ];

    /**
     * melakukan pengecekan terhadap parameter yang diberikan sesuai atau tidak 
     * @param string $filter_type
     * @return bool
     */
    public static function isFilterTypeAllowed($filter_type)
    {
        foreach (static::$filter_types_allowed as $item) {
            if ($item === $filter_type) {
                return true;
            }
        }
        return false;
    }

    /**
     * 
     * @param Database $db
     * @return array
     */
    public static function getReferenceData($db)
    {
        $all_siswa = $db->query('SELECT id_siswa, nis, nama FROM siswa')->get();
        $all_pembayaran = $db->query('SELECT * FROM pembayaran')->get();

        return [
            'all_siswa' => $all_siswa,
            'all_pembayaran' => $all_pembayaran
        ];
    }
}