<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Costomer;
use Illuminate\Support\Facades\DB;

class RekapCharts
{
    public static function buildChart()
    {   
        $tahunSekarang = date('Y');
        $tahun = range(2025,2050);
        $bulan = range(1, 12);
        $pendapatan = array_fill_keys($bulan, 0); // Inisialisasi semua bulan dengan 0

        $data = Costomer::whereIn(DB::raw('MONTH(tanggal)'), $bulan)
            ->whereBetween(DB::raw('YEAR(tanggal)'), [$tahun[0], $tahun[count($tahun) - 1]]) // Filter berdasarkan rentang tahun
            ->selectRaw('MONTH(tanggal) as bulan, SUM(total) as total_pendapatan')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total_pendapatan', 'bulan')
            ->toArray();

        
        foreach ($data as $bln => $pend) {
          $pendapatan[$bln] = $pend;
          
        }


        return (new LarapexChart)
            ->setTitle('Rekap Pendapatan '.$tahunSekarang)
            ->setType('area') // Bisa diganti ke 'bar', 'area', dll.
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'])
            ->setDataset([
                [
                    'name' => 'Pendapatan',
                    'data' => array_values($pendapatan) // Konversi ke array numerik
                ]
            ]);

    }
}
