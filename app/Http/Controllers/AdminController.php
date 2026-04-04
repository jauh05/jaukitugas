<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Komentar;
use App\Models\Costomer;
use App\Models\Admin;
use App\Models\MetodePembayaran;
use App\Models\TalentRegistration;
use App\Charts\RekapCharts;
use App\Charts\CostomerCharts;
use Carbon\Carbon;


class AdminController extends Controller
{
    function index()
    {
        Carbon::setLocale('id'); // Set locale to Indonesian
        $now = Carbon::now();
        $bulanSekarang = $now->month;
        $tahunSekarang = $now->year;

        $data['tahunSekarang'] = $tahunSekarang;
        $data['namaBulanSekarang'] = $now->translatedFormat('F Y');

        // Records for the past two years
        $data['tahun_1'] = Costomer::whereYear('tanggal', $tahunSekarang - 1)->sum('total');
        $data['tahun_2'] = Costomer::whereYear('tanggal', $tahunSekarang - 2)->sum('total');

        $dataBulan = range(1, 12);
        
        // Detailed monthly records for last year (tahun_1)
        $total_perbulan = [];
        $total_costomer = [];
        foreach ($dataBulan as $bulan) {
            $total_perbulan[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 1)->whereMonth('tanggal', $bulan)->sum('total');
            $total_costomer[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 1)->whereMonth('tanggal', $bulan)->count();
        }
        $data['bulanLalu'] = $total_perbulan;
        $data['costomerLalu'] = $total_costomer;

        // Detailed monthly records for two years ago (tahun_2)
        $total_perbulan2 = [];
        $total_costomer2 = [];
        foreach ($dataBulan as $bulan) {
            $total_perbulan2[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 2)->whereMonth('tanggal', $bulan)->sum('total');
            $total_costomer2[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 2)->whereMonth('tanggal', $bulan)->count();
        }
        $data['bulanLalu2'] = $total_perbulan2;
        $data['costomerLalu2'] = $total_costomer2;

        // General Stats
        $data['komentar'] = Komentar::all();
        $data['jumlah_komentar'] = $data['komentar']->count();
        $data['jumlah_costomer_sudah'] = Costomer::where('selesaikan', 'sudah')->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['jumlah_costomer_belum'] = Costomer::where('selesaikan', 'belum')->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['jumlah_talent'] = TalentRegistration::where('status', 'pending')->count();
        $data['total_pendapatan'] = Costomer::whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');

        // NEW: Daily Recap
        $data['rekap_harian_count'] = Costomer::whereDay('tanggal', $now->day)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['rekap_harian_sum'] = Costomer::whereDay('tanggal', $now->day)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');

        // NEW: Overall Recap
        $data['rekap_total_count'] = Costomer::count();
        $data['rekap_total_sum'] = Costomer::sum('total');

        // NEW: Last Month Recap
        $lastMonth = Carbon::now()->subMonth();
        $data['rekap_bulan_lalu_nama'] = $lastMonth->translatedFormat('F Y');
        $data['rekap_bulan_lalu_count'] = Costomer::whereMonth('tanggal', $lastMonth->month)->whereYear('tanggal', $lastMonth->year)->count();
        $data['rekap_bulan_lalu_sum'] = Costomer::whereMonth('tanggal', $lastMonth->month)->whereYear('tanggal', $lastMonth->year)->sum('total');

        // NEW: Daily Chart Data
        $daysInMonth = $now->daysInMonth;
        $dailyIncome = [];
        $dailyCount = [];
        $dailyDays = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dailyDays[] = $i;
            $dailyIncome[] = Costomer::whereDay('tanggal', $i)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');
            $dailyCount[] = Costomer::whereDay('tanggal', $i)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        }
        $data['chart_daily_label'] = json_encode($dailyDays);
        $data['chart_daily_data'] = json_encode($dailyIncome);
        $data['chart_daily_count'] = json_encode($dailyCount);

        // Top Customers
        $data['top_customers'] = Costomer::select('nama', DB::raw('count(*) as total_order'), DB::raw('sum(total) as total_spend'))
            ->groupBy('nama')
            ->orderByDesc('total_spend')
            ->take(20)
            ->get();

        $data['chart'] = RekapCharts::buildChart();
        $data['chartCos'] = CostomerCharts::buildChart();
        return view('t_komentar', $data);
    }

    function komentar()
    {
        $data['komentar'] = Komentar::all();
        return view('komentar_tampil', $data);
    }
    function index2()
    {
        return view('rekap');
    }

    function edit($id_komentar)
    {
        $data['komentar'] = Komentar::find($id_komentar);
        return view('edit_t_komentar', $data);
    }

    function update(Request $request, $id_komentar)
    {


        $masuk['nama'] = $request->nama;
        $masuk['tentang'] = $request->tentang;
        $masuk['komentar'] = $request->komentar;

        Komentar::find($id_komentar)->update($masuk);
        return redirect('/dashboard')->with('pesan_berhasil', 'Komentar dengan id : ' . $id_komentar . ' berhasil di ubah, cek dalam tabel untuk mengetahuinya!!!');
    }

    function delete(Request $request, $id_komentar)
    {
        Komentar::find($id_komentar)->delete();
        return redirect('/dashboard')->with('pesan_berhasil', 'Komentar dengan id :' . $id_komentar . ' berhasil dihapus!!!!');
    }
}
