<?php

class Admin extends AdminController
{

    /**
     * menampilkan halaman dashboard
     */
    public function index()
    {
        return $this->render('admin/index');
    }

    public function laporan($tahun)
    {
        $reportHelper = new ReportHelper();

        $all_month = [
            1 => $reportHelper->countMonthlyEarning($tahun, 1),
            2 => $reportHelper->countMonthlyEarning($tahun, 2),
            3 => $reportHelper->countMonthlyEarning($tahun, 3),
            4 => $reportHelper->countMonthlyEarning($tahun, 4),
            5 => $reportHelper->countMonthlyEarning($tahun, 5),
            6 => $reportHelper->countMonthlyEarning($tahun, 6),
            7 => $reportHelper->countMonthlyEarning($tahun, 7),
            8 => $reportHelper->countMonthlyEarning($tahun, 8),
            9 => $reportHelper->countMonthlyEarning($tahun, 9),
            10 => $reportHelper->countMonthlyEarning($tahun, 10),
            11 => $reportHelper->countMonthlyEarning($tahun, 11),
            12 => $reportHelper->countMonthlyEarning($tahun, 12),
        ];

        $annual_earning = $reportHelper->countAnnualEarning($tahun);
        $count_transaction = $reportHelper->countTransaction($tahun);
        
        $data = [
            'all_month' => $all_month,
            'annual_earning' => $annual_earning,
            'count_transaction' => $count_transaction
        ];

        return $this->view('admin/laporan',$data);
    }
}