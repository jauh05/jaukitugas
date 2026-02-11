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
        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        $dataBulan = range(1, 12);
        $data['tahunSekarang'] = $tahunSekarang;


        $data['tahun_1'] = Costomer::whereYear('tanggal', $tahunSekarang - 1)->sum('total');
        $data['tahun_2'] = Costomer::whereYear('tanggal', $tahunSekarang - 2)->sum('total');


        $total_perbulan = [];
        $total_costomer = [];
        foreach ($dataBulan as $bulan) {
            $total_perbulan[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 1)->whereMonth('tanggal', $bulan)->sum('total');
            $total_costomer[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 1)->whereMonth('tanggal', $bulan)->count();
        }
        ;

        $data['bulanLalu'] = $total_perbulan;
        $data['costomerLalu'] = $total_costomer;


        $total_perbulan2 = [];
        $total_costomer2 = [];
        foreach ($dataBulan as $bulan) {
            $total_perbulan2[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 2)->whereMonth('tanggal', $bulan)->sum('total');
            $total_costomer2[$bulan] = Costomer::whereYear('tanggal', $tahunSekarang - 2)->whereMonth('tanggal', $bulan)->count();
        }
        ;

        $data['bulanLalu2'] = $total_perbulan2;
        $data['costomerLalu2'] = $total_costomer2;

        // dd($data['bulanLalu']);

        $data['komentar'] = Komentar::all();
        $data['jumlah_komentar'] = Komentar::all()->count();
        $data['jumlah_costomer_sudah'] = Costomer::where('selesaikan', 'sudah')->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['jumlah_costomer_belum'] = Costomer::where('selesaikan', 'belum')->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['jumlah_talent'] = TalentRegistration::where('status', 'pending')->count();
        $data['total_pendapatan'] = Costomer::whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');

        $data['metode'] = MetodePembayaran::all();
        $data['metode_id1'] = Costomer::where('id_metode', 1)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['total_id1'] = Costomer::where('id_metode', 1)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');
        $data['metode_id2'] = Costomer::where('id_metode', 2)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['total_id2'] = Costomer::where('id_metode', 2)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');
        $data['metode_id3'] = Costomer::where('id_metode', 3)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['total_id3'] = Costomer::where('id_metode', 3)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');
        $data['metode_id4'] = Costomer::where('id_metode', 4)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['total_id4'] = Costomer::where('id_metode', 4)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');

        // NEW: Daily Recap
        $hariSekarang = date('d');
        $data['rekap_harian_count'] = Costomer::whereDay('tanggal', $hariSekarang)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['rekap_harian_sum'] = Costomer::whereDay('tanggal', $hariSekarang)->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->sum('total');

        // NEW: Overall Recap
        $data['rekap_total_count'] = Costomer::count();
        $data['rekap_total_sum'] = Costomer::sum('total');

        // NEW: Last Month Recap
        $lastMonth = Carbon::now()->subMonth();
        $data['rekap_bulan_lalu_count'] = Costomer::whereMonth('tanggal', $lastMonth->month)->whereYear('tanggal', $lastMonth->year)->count();
        $data['rekap_bulan_lalu_sum'] = Costomer::whereMonth('tanggal', $lastMonth->month)->whereYear('tanggal', $lastMonth->year)->sum('total');

        // NEW: Daily Chart Data (Income & Count per day for current month)
        $daysInMonth = Carbon::now()->daysInMonth;
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

        $jumlahmetode = MetodePembayaran::count();
        $nama = MetodePembayaran::pluck('metode.nama_metode')
            ->toArray();

        $total = Costomer::join('metode', 'metode.id_metode', '=', 'costomer.id_metode')
            ->whereIn('metode.nama_metode', $nama)
            ->selectRaw('metode.nama_metode, COUNT(*) as jumlah')
            ->groupBy('metode.nama_metode')
            ->get();

        $nama1 = MetodePembayaran::join('costomer', 'costomer.id_metode', '=', 'metode.id_metode')
            ->select('metode.nama_metode', DB::raw('COUNT(costomer.id_metode) as jumlah_pembayaran ,SUM(costomer.total) as total_harga'))
            ->whereIn('metode.nama_metode', $nama)
            ->whereMonth('tanggal', $bulanSekarang)
            ->whereYear('tanggal', $tahunSekarang) // Menggunakan whereIn untuk banyak nama
            ->groupBy('metode.nama_metode')
            ->get();


        // NEW: Top Customers (Loyal Customers) - Fetching Top 20 for modal support
        $data['top_customers'] = Costomer::select('nama', DB::raw('count(*) as total_order'), DB::raw('sum(total) as total_spend'))
            ->groupBy('nama')
            ->orderByDesc('total_spend')
            ->take(20)
            ->get();
        // Removed Payment Method and Status Chart Logic as requested

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
