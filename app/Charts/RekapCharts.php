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
        $bulanRange = range(1, 12);
        $pendapatan = array_fill_keys($bulanRange, 0);

        // Fetch data ONLY for the current year
        $data = Costomer::whereYear('tanggal', $tahunSekarang)
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
            ->setType('area')
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'])
            ->setDataset([
                [
                    'name' => 'Pendapatan',
                    'data' => array_values($pendapatan)
                ]
            ]);
    }
}
