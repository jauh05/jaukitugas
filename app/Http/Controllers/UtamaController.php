<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Komentar;
use App\Models\Costomer;
use App\Models\Admin;
use App\Models\Article;

class UtamaController extends Controller
{
    function index()
    {
        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        $data['jumlah_costomer_belum'] = Costomer::where('selesaikan', 'belum')->whereMonth('tanggal', $bulanSekarang)->whereYear('tanggal', $tahunSekarang)->count();
        $data['komentar'] = Komentar::all();
        
        $data['latest_articles'] = Article::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get(['id', 'title', 'slug', 'excerpt', 'featured_image', 'category', 'published_at']);

        return view('halUtama', $data);
    }
    function index2()
    {
        $data['komentar'] = Komentar::all();

        return view('login', $data);
    }

    function dologin(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username' => ['required'],
            'password' => ['required'],

        ]);

        $username = $request->username;
        $pass = sha1($request->password);

        $user = Admin::where('username', $username)->where('password', $pass)->first();
        if (empty($user)) {
            return redirect('login')->with('pesan_gagal', 'password dan username salah');
        } else {
            $request->session()->put('id_admin', $user->id_admin);
            $request->session()->put('username', $user->username);
            return redirect('dashboard')->with('pesan_berhasil', 'berhasil login');
        }

    }

    function logout(Request $request)
    {
        $request->session()->forget(['id_admin', 'username']);
        $request->session()->flush();
        return redirect('login')->with('pesan_berhasil', 'berhasil logout');
    }

    function store(Request $request)
    {
        // Bersihkan dulu (buang tag HTML dan karakter kontrol), baru validasi hasil bersihnya
        $bersih = [
            'nama' => $this->teksAman($request->input('nama', '')),
            'tentang' => $this->teksAman($request->input('tentang', '')),
            'komentar' => $this->teksAman($request->input('komentar', '')),
        ];

        $validated = Validator::make($bersih, [
            'nama' => ['required', 'string', 'min:2', 'max:60'],
            'tentang' => ['required', 'string', 'min:2', 'max:80'],
            'komentar' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'komentar.min' => 'Komentar terlalu pendek.',
            'komentar.required' => 'Komentar wajib diisi dengan teks.',
        ])->validate();

        Komentar::create($validated);
        return redirect('/')->with('pesan_berhasil', 'Terima kasih! Komentar Anda berhasil dikirim.');
    }

    // Hanya teks biasa: tanpa tag HTML/script, tanpa karakter kontrol, spasi dirapikan
    private function teksAman(string $teks): string
    {
        $teks = strip_tags($teks);
        $teks = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $teks);
        return trim(preg_replace('/\s+/u', ' ', $teks));
    }

    function pricelist()
    {
        return view('pricelist');
    }

    function payment()
    {
        return view('payment');
    }
}
