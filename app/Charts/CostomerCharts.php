<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Costomer;
use Illuminate\Support\Facades\DB;

class CostomerCharts
{
    public static function buildChart()
    {   
        $bulan = range(1,12);
        $tahunSekarang = date('Y');
        $bulanSekarang = date('m');
        $chart = new LarapexChart();

        $jumlahCos = [];

        foreach ($bulan as $key ) {
            $jumlahCos[] = Costomer::whereYear('tanggal',$tahunSekarang)->whereMonth('tanggal',$key)->count();
        }

        return $chart->horizontalBarChart()
            ->setTitle('Rekap Costomer ' .$tahunSekarang)
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Jumlah Costomer', $jumlahCos)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June','Juli','Agustus','September','Oktober','November','Desember']);
    }
}