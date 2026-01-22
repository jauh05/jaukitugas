<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Komentar;
use App\Models\Costomer;
use App\Models\Admin;

class UtamaController extends Controller
{
    function index(){
        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        $data['jumlah_costomer_belum'] = Costomer::where('selesaikan','belum')->whereMonth('tanggal',$bulanSekarang)->whereYear('tanggal',$tahunSekarang)->count();
        $data['komentar'] = Komentar::all(); 

        return view('halUtama',$data);
    }
    function index2(){
        $data['komentar'] = Komentar::all(); 

        return view('login',$data);
    }

    function dologin(Request $request): RedirectResponse{
        $validatedData = $request->validate([
            'username' => ['required'], 
            'password' => ['required'],
           
        ]);

        $username = $request->username;
        $pass = sha1($request->password);

        $user = Admin::where('username',$username)->where('password',$pass)->first();
        if(empty($user)){
            return redirect('login')->with('pesan_gagal','password dan username salah');
        }else{
            $request->session()->put('id_admin',$user->id_admin);
            $request->session()->put('username',$user->username);
            return redirect('dashboard')->with('pesan_berhasil','berhasil login');
        }

    }

    function logout(Request $request){
        $request->session()->forget(['id_admin','username']);
        $request->session()->flush();
        return redirect('login')->with('pesan_gagal','berhasil logout');
    }

    function store(Request $request){
        
        $nama = $request->nama;
        $tentang = $request->tentang;
        $komentar = $request->komentar;

        $masuk['nama'] = $nama;
        $masuk['tentang'] = $tentang;
        $masuk['komentar'] = $komentar;

      
        Komentar::create($masuk);
        return redirect('/utama');

    }
}
